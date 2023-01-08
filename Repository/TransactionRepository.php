<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Repository;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TransactionRepository.
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }
}
