<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Option;

class OptionResponse
{
    public int $code;
    public string $message;
    public ?Option $result;
}
