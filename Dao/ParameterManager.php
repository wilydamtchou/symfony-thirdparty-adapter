<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Dao;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Parameter;
use Willydamtchou\SymfonyThirdpartyAdapter\Service\UtilService;
use Doctrine\ORM\EntityManagerInterface;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\ParameterManager as BaseParameterManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Parameter as BaseParameter;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

class ParameterManager implements BaseParameterManager
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
    public function save(BaseParameter $entity): Parameter
    {
        $entity->parameterId = $this->utilService->randomString($_ENV['APP_DB_ID_LENGTH']);

        if ($this->findOneByParameterId($entity->parameterId, false)) {
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
    public function update(BaseParameter $entity): Parameter
    {
        $entity->lastUpdatedDate = new \DateTime(AppConstants::NOW, new \DateTimeZone($_ENV['TIME_ZONE']));

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Parameter
    {
        $entity = $this->entityManager->getRepository(Parameter::class)->find($id);

        if (!$entity) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::PARAMETER, AppConstants::ID, $id));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByParameterId(int $parameterId, bool $throw = true): ?Parameter
    {
        $entity = $this->entityManager->getRepository(Parameter::class)->findOneByParameterId($parameterId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::PARAMETER, AppConstants::PARAMETER_ID, $parameterId));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneBySlug(string $slug, bool $throw = true): ?Parameter
    {
        $entity = $this->entityManager->getRepository(Parameter::class)->findOneBySlug($slug);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::PARAMETER, AppConstants::SLUG, $slug));
        }

        return $entity;
    }

    /**
     * @throws \Exception
     */
    public function updateValue(string $slug, string $value): BaseParameter
    {
        $parameter = $this->findOneBySlug($slug);
        $parameter->value = $value;

        return $this->update($parameter);
    }
}
