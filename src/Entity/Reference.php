<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Entity;

use Willydamtchou\SymfonyThirdpartyAdapter\Repository\ReferenceRepository;
use Doctrine\ORM\Mapping as ORM;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Reference as BaseReference;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Reference.
 */
#[ORM\Entity(repositoryClass: ReferenceRepository::class)]
class Reference extends BaseReference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(name: 'referenceId', type: 'bigint', unique: true, nullable: false)]
    public int $referenceId;

    #[ORM\Column(name: 'referenceNumber', unique: true, nullable: false)]
    public string $referenceNumber;

    #[ORM\Column(nullable: true)]
    public ?float $amount = null;

    #[ORM\Column(name: 'createdDate', type: 'datetime', nullable: false)]
    public \DateTime $createdDate;

    #[ORM\Column(name: 'lastUpdatedDate', type: 'datetime', nullable: false)]
    public \DateTime $lastUpdatedDate;

    #[ORM\Column(nullable: false)]
    public Status $status;

    #[ORM\Column(name: 'generatedDate', type: 'datetime', nullable: true)]
    public ?\DateTime $generatedDate;

    #[ORM\Column(name: 'expiratedDate', type: 'datetime', nullable: true)]
    public ?\DateTime $expiratedDate;

    #[ORM\Column(name: 'name', type: 'string', nullable: true)]
    public ?string $name;

    #[ORM\Column(name: 'customerId', type: 'string', nullable: true)]
    public ?string $customerId;

    #[ORM\Column(name: 'billType', type: 'string', nullable: true)]
    public ?string $billType;

    #[ORM\Column(name: 'ref4', type: 'string', nullable: true)]
    public ?string $ref4;

    #[ORM\Column(name: 'billId', type: 'string', nullable: true)]
    public ?string $billId;

    #[ORM\Column(name: 'meterNumber', type: 'string', nullable: true)]
    public ?string $meterNumber;

    #[ORM\Column(name: 'billStatus', type: 'string', nullable: true)]
    public ?string $billStatus;

    #[ORM\Column(name: 'billStatusDesc', type: 'string', nullable: true)]
    public ?string $billStatusDesc;

    #[ORM\Column(name: 'billTypeDesc', type: 'string', nullable: true)]
    public ?string $billTypeDesc;

    #[ORM\Column(name: 'agence', type: 'string', nullable: true)]
    public ?string $agence;

    /**
     * void.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }
}
