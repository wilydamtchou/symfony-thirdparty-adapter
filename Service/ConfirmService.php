<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\IllegalStatusConfirmException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ConfirmService as BaseConfirmService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;

class ConfirmService implements BaseConfirmService
{
    protected TransactionService $transactionService;
    protected ReferenceService $referenceService;

    public function __construct(TransactionService $transactionService, ReferenceService $referenceService)
    {
        $this->transactionService = $transactionService;
        $this->referenceService = $referenceService;
    }

    /**
     *@throws IllegalStatusConfirmException
     */
    public function confirm(int $transactionId): Transaction
    {
        $transaction = $this->transactionService->findOneByTransactionId($transactionId);

        if (Status::PENDING != $transaction->status && Status::PROGRESS != $transaction->status) {
            throw new IllegalStatusConfirmException($transaction->transactionId, $transaction->status->value);
        }

        return $this->transactionService->updateStatus($transaction->id, Status::SUCCESS);
    }
}
