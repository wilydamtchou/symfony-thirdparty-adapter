<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\GeneralException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RegulateException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\PaymentErrorService as BasePaymentErrorService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;

class PaymentErrorService implements BasePaymentErrorService
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function error(\Throwable $exception, BaseTransaction $transaction): RegulateException
    {
        if (Status::FAILED != $transaction->status && Status::SUCCESS != $transaction->status) {
            $this->transactionService->updateStatus($transaction->id, Status::PROGRESS);
        }

        $message = $code = '';

        if ($exception instanceof GeneralException) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
        } elseif (true) {
            $code = SystemExceptionMessage::GENERAL_FAILURE[AppConstants::CODE];
            $message = SystemExceptionMessage::GENERAL_FAILURE[AppConstants::MESSAGE];
            if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                $message = sprintf($message, ', file :'.$exception->getFile().', line: '.$exception->getLine().', message:'.$exception->getMessage());
            } else {
                $message = sprintf($message, '');
            }
        }

        return new RegulateException(','.AppConstants::CODE.': '.$code.', '.AppConstants::MESSAGE.': '.$message);
    }
}
