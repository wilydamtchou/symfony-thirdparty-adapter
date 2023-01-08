<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Repository;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Option;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class OptionRepository.
 */
class OptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Option::class);
    }

    /**
     * @return Option[]
     */
    public function findAllByReference(?string $reference = null): array
    {
        $entityManager = $this->getEntityManager();

        $where = '';

        if ($reference) {
            $where = 'WHERE r.reference = :reference';
        }

        $query = <<<EOF
SELECT r.optionId, r.name, r.slug, r.amount, r.reference, r.status, DATE_FORMAT(r.createdDate, '%Y-%m-%d %H:%i:%s') as date FROM Willydamtchou\SymfonyThirdpartyAdapter\Entity\Option r $where ORDER BY r.amount ASC
EOF;

        $query = $entityManager->createQuery($query);

        if ($reference) {
            $query->setParameter('reference', $reference);
        }

        // returns an array of Product objects
        return $query->getArrayResult();
    }
}
