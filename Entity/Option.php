<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Entity;

use Willydamtchou\SymfonyThirdpartyAdapter\Repository\OptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Option as BaseOption;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Option.
 */
#[ORM\Entity(repositoryClass: OptionRepository::class)]
#[ORM\Table(name: 'referenceOption')]
class Option extends BaseOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(name: 'optionId', type: 'bigint', unique: true, nullable: false)]
    public int $optionId;

    #[ORM\Column(unique: true, nullable: false)]
    public String $name;

    #[ORM\Column(unique: true, nullable: false)]
    public String $slug;

    #[ORM\Column(nullable: false)]
    public float $amount;

    #[ORM\Column(name: 'createdDate', type: 'datetime', nullable: false)]
    public \DateTime $createdDate;

    #[ORM\Column(name: 'lastUpdatedDate', type: 'datetime', nullable: false)]
    public \DateTime $lastUpdatedDate;

    #[ORM\Column(nullable: false)]
    public Status $status;

    #[ORM\Column(nullable: true)]
    public ?string $reference;

    /**
     * void.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->status = Status::ENABLED;
    }
}
