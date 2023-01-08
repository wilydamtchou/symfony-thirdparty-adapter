<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Option;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionEntityCollection;

interface OptionManager
{
    /**
     * @throws \Exception
     */
    public function save(Option $entity): Option;

    /**
     * @throws \Exception
     */
    public function update(Option $entity): Option;

    /**
     * @throws \Exception
     */
    public function saveList(OptionEntityCollection $entities): OptionCollection;

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Option;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByOptionId(int $optionId, $throw = true): ?Option;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneBySlug(string $slug, bool $throw = true): ?Option;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByReferenceAndSlug(string $reference, string $slug, bool $throw = true): ?Option;

    /**
     * @throws EntityNotFoundException
     */
    public function findByReference(string $reference, bool $throw = true): ?OptionCollection;

    /**
     * @throws EntityNotFoundException
     */
    public function findAll(bool $throw = true): ?OptionCollection;
}
