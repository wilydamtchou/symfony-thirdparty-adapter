<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Reference;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EntityNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;

interface ReferenceManager
{
    /**
     * @throws \Exception
     */
    public function saveWith(string $referenceNumber): Reference;

    /**
     * @throws \Exception
     */
    public function save(Reference $entity): Reference;

    /**
     * @throws \Exception
     */
    public function update(Reference $entity): Reference;

    /**
     * @throws EntityNotFoundException
     */
    public function find(int $id): Reference;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByReferenceNumber(string $referenceNumber, bool $throw = true): ?Reference;

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByReferenceId(int $referenceId, bool $throw = true): ?Reference;

    /**
     * @throws \Exception
     */
    public function updateStatus(string $referenceNumber, Status $status): Reference;
}
