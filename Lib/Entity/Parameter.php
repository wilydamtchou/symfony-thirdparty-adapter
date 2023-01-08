<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\BaseEntity;

class Parameter extends BaseEntity
{
    public int $id;
    public int $parameterId;
    public string $name;
    public string $slug;
    public string $value;

    /**
     * void.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }
}
