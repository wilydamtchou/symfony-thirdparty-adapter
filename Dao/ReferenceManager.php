<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Dao;

use Willydamtchou\SymfonyThirdpartyAdapter\Service\UtilService;
use Doctrine\ORM\EntityManagerInterface;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\ReferenceManager as BaseReferenceManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Reference;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

class ReferenceManager implements BaseReferenceManager
{
    protected EntityManagerInterface $entityManager;
    protected UtilService $utilService;
    protected string $class = Reference::class;

    public function __construct(EntityManagerInterface $entityManager, UtilService $utilService)
    {
        $this->entityManager = $entityManager;
        $this->utilService = $utilService;
    }

    /**
     * @throws \Exception
     */
    public function saveWith(string $referenceNumber): Reference
    {
        $reference = new Reference();
        $reference->referenceNumber = $referenceNumber;

        return $this->save($reference);
    }

    /**
     * @throws \Exception
     */
    public function save(Reference $entity): Reference
    {
        $entity->referenceId = $this->utilService->randomString($_ENV['APP_DB_ID_LENGTH']);

        if ($this->findOneByReferenceId($entity->referenceId, false)) {
            return $this->save($entity);
        }

        $entity->lastUpdatedDate = new \DateTime(AppConstants::NOW, new \DateTimeZone($_ENV['TIME_ZONE']));

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @throws \Exception
     */
    public function update(Reference $entity): Reference
    {
        $entity->lastUpdatedDate = new \DateTime(AppConstants::NOW, new \DateTimeZone($_ENV['TIME_ZONE']));

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Reference
    {
        $entity = $this->entityManager->getRepository($this->class)->find($id);

        if (!$entity) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::REFERENCE, AppConstants::ID, $id));
        }

        if ($entity instanceof Reference) {
            $entity->date = $entity->lastUpdatedDate->format($_ENV['API_DATE_FORMAT']);
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByReferenceId(int $referenceId, bool $throw = true): ?Reference
    {
        $entity = $this->entityManager->getRepository($this->class)->findOneByReferenceId($referenceId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::REFERENCE, AppConstants::REFERENCE_ID, $referenceId));
        }

        if ($entity instanceof Reference) {
            $entity->date = $entity->lastUpdatedDate->format($_ENV['API_DATE_FORMAT']);
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByReferenceNumber(string $referenceNumber, bool $throw = true): ?Reference
    {
        $entity = $this->entityManager->getRepository($this->class)->findOneByReferenceNumber($referenceNumber);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::REFERENCE, AppConstants::REFERENCE_NUMBER, $referenceNumber));
        }

        if ($entity instanceof Reference) {
            $entity->generationDate = $entity->generatedDate->format($_ENV['API_DATE_FORMAT']);
            $entity->expirationDate = $entity->expiratedDate->format($_ENV['API_DATE_FORMAT']);
            $entity->date = $entity->lastUpdatedDate->format($_ENV['API_DATE_FORMAT']);
        }

        return $entity;
    }

    /**
     * @throws \Exception
     */
    public function updateStatus(string $referenceNumber, Status $status): Reference
    {
        $entity = $this->findOneByReferenceNumber($referenceNumber);
        $entity->status = $status;

        return $this->update($entity);
    }
}
