<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\IllegalStatusCancelException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\CancelService as BaseCancelService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;

class CancelService implements BaseCancelService
{
    protected TransactionService $transactionService;
    protected ReferenceService $referenceService;

    public function __construct(TransactionService $transactionService, ReferenceService $referenceService)
    {
        $this->transactionService = $transactionService;
        $this->referenceService = $referenceService;
    }

    /**
     * @param int $transactionId
     *
     * @throws IllegalStatusCancelException
     * @return Transaction
     */
    public function cancel(int $transactionId): Transaction
    {
        $transaction = $this->transactionService->findOneByTransactionId($transactionId);

        if (Status::PENDING != $transaction->status && Status::PROGRESS != $transaction->status) {
            throw new IllegalStatusCancelException($transaction->transactionId, $transaction->status->value);
        }

        return $this->transactionService->updateStatus($transaction->id, Status::CANCELED);
    }
}
