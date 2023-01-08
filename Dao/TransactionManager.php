<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Dao;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Service\UtilService;
use Doctrine\ORM\EntityManagerInterface;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\TransactionManager as BaseTransactionManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

class TransactionManager implements BaseTransactionManager
{
    protected EntityManagerInterface $entityManager;
    protected UtilService $utilService;

    public function __construct(EntityManagerInterface $entityManager, UtilService $utilService)
    {
        $this->entityManager = $entityManager;
        $this->utilService = $utilService;
    }

    /**
     * @throws \Exception
     */
    public function save(BaseTransaction $entity): Transaction
    {
        $entity->transactionId = $this->utilService->randomString($_ENV['APP_DB_ID_LENGTH']);

        if ($this->findOneByTransactionId($entity->transactionId, false)) {
            return $this->save($entity);
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @throws \Exception
     */
    public function update(BaseTransaction $entity): Transaction
    {
        $entity->lastUpdatedDate = new \DateTime(AppConstants::NOW, new \DateTimeZone($_ENV['TIME_ZONE']));

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Transaction
    {
        $entity = $this->entityManager->getRepository(Transaction::class)->find($id);

        if (!$entity) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::TRANSACTION, AppConstants::ID, $id));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByTransactionId(int $transactionId, bool $throw = true): ?Transaction
    {
        $entity = $this->entityManager->getRepository(Transaction::class)->findOneByTransactionId($transactionId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::TRANSACTION, AppConstants::TRANSACTION_ID, $transactionId));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByFinancialId(string $financialId, bool $throw = true): ?Transaction
    {
        $entity = $this->entityManager->getRepository(Transaction::class)->findOneByFinancialId($financialId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::TRANSACTION, AppConstants::FINANCIAL_ID, $financialId));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByApplicationId(string $applicationId, bool $throw = true): ?Transaction
    {
        $entity = $this->entityManager->getRepository(Transaction::class)->findOneByApplicationId($applicationId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::TRANSACTION, AppConstants::APPLICATION_ID, $applicationId));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByExternalId(string $externalId, bool $throw = true): ?Transaction
    {
        $entity = $this->entityManager->getRepository(Transaction::class)->findOneByExternalId($externalId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::TRANSACTION, AppConstants::EXTERNAL_ID, $externalId));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByRequestId(string $requestId, bool $throw = true): ?Transaction
    {
        $entity = $this->entityManager->getRepository(Transaction::class)->findOneByRequestId($requestId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::TRANSACTION, AppConstants::REQUEST_ID, $requestId));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByProviderId(string $providerId, bool $throw = true): ?Transaction
    {
        $entity = $this->entityManager->getRepository(Transaction::class)->findOneByProviderId($providerId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::TRANSACTION, AppConstants::PROVIDER_ID, $providerId));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneBy(array $data): Transaction
    {
        $entity = $this->entityManager->getRepository(Transaction::class)->findOneBy($data);

        if (!$entity) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::TRANSACTION, http_build_query($data, '', ','), ''));
        }

        return $entity;
    }

    /**
     * @throws \Exception
     */
    public function updateProviderId(int $id, string $providerId): Transaction
    {
        $transaction = $this->find($id);
        $transaction->providerId = $providerId;

        if ($this->findOneByProviderId($providerId, false)) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_ALREADY_EXIST[AppConstants::MESSAGE], AppConstants::TRANSACTION, AppConstants::PROVIDER_ID, $providerId));
        }

        return $this->update($transaction);
    }

    /**
     * @throws \Exception
     */
    public function updateStatus(int $id, Status $status): Transaction
    {
        $transaction = $this->find($id);
        $transaction->status = $status;

        return $this->update($transaction);
    }

    /**
     * @throws \Exception
     */
    public function updateProviderIdStatus(int $id, string $providerId, Status $status): Transaction
    {
        $transaction = $this->find($id);
        $transaction->status = $status;
        $transaction->providerId = $providerId;

        return $this->update($transaction);
    }

    /**
     * @throws \Exception
     */
    public function updateProviderData(int $id, BaseTransaction $transaction): Transaction
    {
        $entity = $this->find($id);

        foreach (get_object_vars($transaction) as $key => $value) {
            if (property_exists($entity, $key) && null != $value) {
                $entity->$key = $value;
            }
        }

        return $this->update($entity);
    }
}
