<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Repository;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Reference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ReferenceRepository.
 */
class ReferenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reference::class);
    }
}
