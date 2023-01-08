<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * Option.
 */
class Option
{
    public int $optionId;
    public ?String $name = null;
    public ?String $slug = null;
    public ?float $amount = null;
    public ?string $reference = null;
    public ?Status $status = null;
    public ?string $date = null;
}
