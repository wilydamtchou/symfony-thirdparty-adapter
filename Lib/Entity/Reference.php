<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\BaseEntity;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;

class Reference extends BaseEntity
{
    public int $id;
    public int $referenceId;
    public string $referenceNumber;
    public ?float $amount = null;
    public string $generationDate;
    public string $expirationDate;
    public ?\DateTime $generatedDate;
    public ?\DateTime $expiratedDate;
    public ?string $name;
    public OptionCollection|array|null $options = null;

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
