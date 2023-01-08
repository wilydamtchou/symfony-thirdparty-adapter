<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Entity;

use Willydamtchou\SymfonyThirdpartyAdapter\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Transaction.
 */
#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction extends BaseTransaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(name: 'transactionId', type: 'bigint', unique: true, nullable: false)]
    public int $transactionId;

    #[ORM\Column(length: 255, nullable: false)]
    public string $reference;

    #[ORM\Column(name: 'accountNumber', length: 255, nullable: false)]
    public string $accountNumber;

    #[ORM\Column(name: 'accountName', length: 255, nullable: false)]
    public string $accountName;

    #[ORM\Column(nullable: false)]
    public float $amount;

    #[ORM\Column(name: 'createdDate', type: 'datetime', nullable: false)]
    public \DateTime $createdDate;

    #[ORM\Column(name: 'lastUpdatedDate', type: 'datetime', nullable: false)]
    public \DateTime $lastUpdatedDate;

    #[ORM\Column(nullable: false)]
    public Status $status;

    #[ORM\Column(nullable: true)]
    public ?string $phone;

    #[ORM\Column(nullable: true)]
    public ?string $email;

    #[ORM\Column(name: 'optionSlug', nullable: true)]
    public ?string $option;

    #[ORM\Column(name: 'externalId', unique: true, nullable: false)]
    public string $externalId;

    #[ORM\Column(name: 'requestId', unique: true, nullable: false)]
    public string $requestId;

    #[ORM\Column(name: 'applicationId', unique: true, nullable: false)]
    public string $applicationId;

    #[ORM\Column(name: 'financialId', unique: true, nullable: false)]
    public string $financialId;

    #[ORM\Column(name: 'providerId', unique: true, nullable: true)]
    public ?string $providerId = null;

    #[ORM\Column(name: 'providerStatus', nullable: true)]
    public ?string $providerStatus;

    #[ORM\Column(name: 'providerDate', nullable: true)]
    public ?string $providerDate;

    #[ORM\Column(name: 'providerMessage', nullable: true)]
    public ?string $providerMessage;

    #[ORM\Column(name: 'providerBalance', nullable: true)]
    public ?float $providerBalance;

    /**
     * void.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }
}
