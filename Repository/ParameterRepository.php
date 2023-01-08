<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Repository;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Parameter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ParameterRepository.
 */
class ParameterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parameter::class);
    }
}
