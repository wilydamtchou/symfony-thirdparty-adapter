<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Parameter;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;

interface ParameterManager
{
    public function save(Parameter $entity): Parameter;

    /**
     * @throws \Exception
     */
    public function updateValue(string $slug, string $value): Parameter;

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Parameter;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneBySlug(string $slug, bool $throw = true): ?Parameter;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByParameterId(int $parameterId, bool $throw = true): ?Parameter;

    /**
     * @throws \Exception
     */
    public function update(Parameter $entity): Parameter;
}
