<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\TransactionManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityAlReadyExistException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService as BaseTransactionService;

class TransactionService implements BaseTransactionService
{
    protected TransactionManager $transactionManager;

    public function __construct(TransactionManager $transactionManager)
    {
        $this->transactionManager = $transactionManager;
    }

    /**
     * @throws \Exception
     */
    public function save(BaseTransaction $transaction): Transaction
    {
        return $this->transactionManager->save($transaction);
    }

    /**
     * @throws \Exception
     */
    public function update(BaseTransaction $transaction): Transaction
    {
        return $this->transactionManager->update($transaction);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Transaction
    {
        return $this->transactionManager->find($id);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByTransactionId(int $transactionId, bool $throw = true): ?Transaction
    {
        return $this->transactionManager->findOneByTransactionId($transactionId, $throw);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByFinancialId(string $financialId, bool $throw = true): ?Transaction
    {
        return $this->transactionManager->findOneByFinancialId($financialId, $throw);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByApplicationId(string $applicationId, bool $throw = true): ?Transaction
    {
        return $this->transactionManager->findOneByApplicationId($applicationId, $throw);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByExternalId(string $externalId, bool $throw = true): ?Transaction
    {
        return $this->transactionManager->findOneByExternalId($externalId, $throw);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByRequestId(string $requestId, bool $throw = true): ?Transaction
    {
        return $this->transactionManager->findOneByRequestId($requestId, $throw);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByProviderId(string $providerId, bool $throw = true): ?Transaction
    {
        return $this->transactionManager->findOneByProviderId($providerId, $throw);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneBy(array $data): Transaction
    {
        return $this->transactionManager->findOneBy($data);
    }

    /**
     * @throws EntityAlReadyExistException
     */
    public function updateProviderId(int $id, string $providerId): Transaction
    {
        return $this->transactionManager->updateProviderId($id, $providerId);
    }

    public function updateStatus(int $id, Status $status): Transaction
    {
        return $this->transactionManager->updateStatus($id, $status);
    }

    public function updateProviderIdStatus(int $id, string $providerId, Status $status): Transaction
    {
        return $this->transactionManager->updateProviderIdStatus($id, $providerId, $status);
    }

    public function updateProviderData(int $id, BaseTransaction $transaction): Transaction
    {
        return $this->transactionManager->updateProviderData($id, $transaction);
    }
}
