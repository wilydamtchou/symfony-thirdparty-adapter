<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Dao;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Option;
use Willydamtchou\SymfonyThirdpartyAdapter\Service\UtilService;
use Doctrine\ORM\EntityManagerInterface;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\OptionManager as BaseOptionManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Option as BaseOption;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ListEntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Option as ModelOption;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionEntityCollection;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

class OptionManager implements BaseOptionManager
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
    public function save(BaseOption $entity): Option
    {
        $option = $this->generateEntity($entity);
        $option->lastUpdatedDate = new \DateTime(AppConstants::NOW, new \DateTimeZone($_ENV['TIME_ZONE']));
        $this->entityManager->persist($option);
        $this->entityManager->flush();

        return $option;
    }

    /**
     * @throws \Exception
     */
    public function update(BaseOption $entity): Option
    {
        $entity->lastUpdatedDate = new \DateTime(AppConstants::NOW, new \DateTimeZone($_ENV['TIME_ZONE']));
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @throws \Exception
     */
    public function saveList(OptionEntityCollection $entities): OptionCollection
    {
        $response = new OptionCollection();

        foreach ($entities->all() as $value) {
            $this->entityManager->persist($this->generateEntity($value));
            $elt = new ModelOption();

            foreach (get_object_vars($value) as $key => $val) {
                $elt->$key = $val;
            }

            $response->add($elt);
        }

        $this->entityManager->flush();

        return $response;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Option
    {
        $entity = $this->entityManager->getRepository(Option::class)->find($id);

        if (!$entity) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::OPTION, AppConstants::ID, $id));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByOptionId(int $optionId, $throw = true): ?Option
    {
        $entity = $this->entityManager->getRepository(Option::class)->findOneByOptionId($optionId);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::OPTION, AppConstants::OPTION_ID, $optionId));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneBySlug(string $slug, bool $throw = true): ?Option
    {
        $entity = $this->entityManager->getRepository(Option::class)->findOneBySlug($slug);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::OPTION, AppConstants::SLUG, $slug));
        }

        return $entity;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findByReference(string $reference, bool $throw = true): ?OptionCollection
    {
        $entities = $this->entityManager->getRepository(Option::class)->findAllByReference($reference);

        if (!$entities && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::OPTION, AppConstants::REFERENCE, $reference));
        }

        return new OptionCollection($entities);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findAll(bool $throw = true): ?OptionCollection
    {
        $entities = $this->entityManager->getRepository(Option::class)->findAllByReference();

        if (!$entities && $throw) {
            throw new ListEntityNotFoundException(sprintf(SystemExceptionMessage::LIST_ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::OPTION));
        }

        return new OptionCollection($entities);
    }

    public function findOneByReferenceAndSlug(string $reference, string $slug, bool $throw = true): ?BaseOption
    {
        $entity = $this->entityManager->getRepository(Option::class)->findOneBy([AppConstants::REFERENCE => $reference, AppConstants::SLUG => $slug]);

        if (!$entity && $throw) {
            throw new EntityNotFoundException(sprintf(SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::MESSAGE], AppConstants::OPTION, AppConstants::VALUES, json_encode([AppConstants::REFERENCE => $reference, AppConstants::SLUG => $slug])));
        }

        return $entity;
    }

    /**
     * @throws \Exception
     */
    protected function generateEntity(BaseOption $entity): Option
    {
        $entity->optionId = $this->utilService->randomString($_ENV['APP_DB_ID_LENGTH']);

        if ($this->findOneByOptionId($entity->optionId, false)) {
            return $this->save($entity);
        }

        return $entity;
    }
}
