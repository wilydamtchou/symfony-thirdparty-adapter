<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\PaymentFailedService as BasePaymentFailedService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;

class PaymentFailedService implements BasePaymentFailedService
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function failed(PaymentAPIException $exception, BaseTransaction $transaction): PaymentAPIException
    {
        if (Status::PROGRESS == $transaction->status || Status::PENDING == $transaction->status) {
            $this->transactionService->updateStatus($transaction->id, Status::FAILED);
        }

        return $exception;
    }
}
