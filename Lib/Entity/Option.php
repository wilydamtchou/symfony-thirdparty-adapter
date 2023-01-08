<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\BaseEntity;

/**
 * Option.
 */
class Option extends BaseEntity
{
    public int $id;
    public int $optionId;
    public String $name;
    public String $slug;
    public float $amount;
    public ?string $reference;

    /**
     * void.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }
}
