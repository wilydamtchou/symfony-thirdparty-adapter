<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse as BaseProviderPaymentResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentApplicationException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\ApplicationExceptionMessage;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\PaymentSuccessService as BasePaymentSuccessService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;

class PaymentSuccessService implements BasePaymentSuccessService
{
    private TransactionService $transactionService;
    private ReferenceService $referenceService;

    public function __construct(TransactionService $transactionService, ReferenceService $referenceService)
    {
        $this->transactionService = $transactionService;
        $this->referenceService = $referenceService;
    }

    /**
     * @throws \Exception
     */
    public function success(BaseTransaction $transaction, BaseProviderPaymentResponse $response): Transaction
    {
        if (Status::PROGRESS != $transaction->status && Status::PENDING != $transaction->status) {
            throw new PaymentApplicationException(ApplicationExceptionMessage::ILLEGAL_TRANSACTION_STATUS[AppConstants::CODE], sprintf(ApplicationExceptionMessage::ILLEGAL_TRANSACTION_STATUS[AppConstants::MESSAGE], $transaction->status));
        }

        $this->verifyAfterPayment($transaction, $response);

        $transaction->status = Status::SUCCESS;

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['MANUAL_MODE']) {
            $transaction->status = Status::PROGRESS;
        }

        foreach (get_object_vars($response) as $key => $value) {
            if (property_exists($transaction, $key) && null != $value) {
                $transaction->$key = $value;
            }
        }

        $transaction = $this->transactionService->updateProviderData($transaction->id, $transaction);

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['SET_BALANCE_AFTER_PAYMENT']) {
            $this->setBalance($transaction);
        }

        if ($_ENV['REFERENCE_API_ENABLED']) {
            $this->referenceService->updateStatus($transaction->reference, Status::SUCCESS);
        }

        return $transaction;
    }

    public function verifyAfterPayment(BaseTransaction $transaction, BaseProviderPaymentResponse $response): void
    {
    }

    public function setBalance(BaseTransaction $transaction): void
    {
    }
}
