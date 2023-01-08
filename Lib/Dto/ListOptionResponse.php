<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\OptionCollection;

class ListOptionResponse
{
    public int $code;
    public string $message;
    public ?OptionCollection $result;
}
