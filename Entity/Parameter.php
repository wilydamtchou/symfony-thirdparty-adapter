<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Entity;

use Willydamtchou\SymfonyThirdpartyAdapter\Repository\ParameterRepository;
use Doctrine\ORM\Mapping as ORM;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Parameter as BaseParameter;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;

/**
 * Parameter.
 */
#[ORM\Entity(repositoryClass: ParameterRepository::class)]
class Parameter extends BaseParameter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(name: 'parameterId', type: 'bigint', unique: true, nullable: false)]
    public int $parameterId;

    #[ORM\Column(name: 'name', unique: true, nullable: false)]
    public string $name;

    #[ORM\Column(name: 'slug', unique: true, nullable: false)]
    public string $slug;

    #[ORM\Column(name: 'value', nullable: false)]
    public string $value;

    #[ORM\Column(name: 'createdDate', type: 'datetime', nullable: false)]
    public \DateTime $createdDate;

    #[ORM\Column(name: 'lastUpdatedDate', type: 'datetime', nullable: false)]
    public \DateTime $lastUpdatedDate;

    #[ORM\Column(nullable: false)]
    public Status $status;

    /**
     * void.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->status = Status::ENABLED;
    }
}
