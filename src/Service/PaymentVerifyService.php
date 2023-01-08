<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\DuplicateApplicationIdException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\DuplicateExternalIdException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\DuplicateFinancialIdException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\DuplicateRequestIdException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RequiredAccountNameException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RequiredAccountNumberException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RequiredApplicationIdException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RequiredExternalIdException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RequiredFinancialIdException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RequiredRequestIdException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\PaymentVerifyService as BasePaymentVerifyService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\VerifyService;

class PaymentVerifyService implements BasePaymentVerifyService
{
    private TransactionService $transactionService;
    private VerifyService $verifyService;

    public function __construct(TransactionService $transactionService, VerifyService $verifyService)
    {
        $this->transactionService = $transactionService;
        $this->verifyService = $verifyService;
    }

    /**
     * @throws PaymentException
     */
    public function verify(PaymentRequest $paymentRequest): void
    {
        $this->verifyService->verify($paymentRequest);

        if (!$paymentRequest->applicationId) {
            throw new RequiredApplicationIdException();
        }

        if ($this->transactionService->findOneByApplicationId($paymentRequest->applicationId, false)) {
            throw new DuplicateApplicationIdException($paymentRequest->applicationId);
        }

        if (!$paymentRequest->requestId) {
            throw new RequiredRequestIdException();
        }

        if ($this->transactionService->findOneByRequestId($paymentRequest->requestId, false)) {
            throw new DuplicateRequestIdException($paymentRequest->requestId);
        }

        if (!$paymentRequest->externalId) {
            throw new RequiredExternalIdException();
        }

        if ($this->transactionService->findOneByExternalId($paymentRequest->externalId, false)) {
            throw new DuplicateExternalIdException($paymentRequest->externalId);
        }

        if (!$paymentRequest->financialId) {
            throw new RequiredFinancialIdException();
        }

        if ($this->transactionService->findOneByFinancialId($paymentRequest->financialId, false)) {
            throw new DuplicateFinancialIdException($paymentRequest->financialId);
        }

        if (!$paymentRequest->accountNumber) {
            throw new RequiredAccountNumberException();
        }

        if (!$paymentRequest->accountName) {
            throw new RequiredAccountNameException();
        }
    }
}
