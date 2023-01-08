<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityAlReadyExistException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;

interface TransactionService
{
    public function save(Transaction $transaction): Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByTransactionId(int $transactionId, bool $throw = true): ?Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByFinancialId(string $financialId, bool $throw = true): ?Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByApplicationId(string $applicationId, bool $throw = true): ?Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByExternalId(string $externalId, bool $throw = true): ?Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByRequestId(string $requestId, bool $throw = true): ?Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByProviderId(string $providerId, bool $throw = true): ?Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneBy(array $data): Transaction;

    /**
     * @throws EntityAlReadyExistException
     */
    public function updateProviderId(int $id, string $providerId): Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function updateStatus(int $id, Status $status): Transaction;

    /**
     * @throws EntityNotFoundException
     */
    public function updateProviderIdStatus(int $id, string $providerId, Status $status): Transaction;

    /**
     * @throws EntityAlReadyExistException
     */
    public function updateProviderData(int $id, Transaction $transaction): Transaction;

    /**
     * @throws \Exception
     */
    public function update(Transaction $transaction): Transaction;
}
