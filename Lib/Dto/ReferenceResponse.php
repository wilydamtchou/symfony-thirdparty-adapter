<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Reference;

class ReferenceResponse
{
    public int $code;
    public string $message;
    public ?Reference $result;
    public ?array $options;
}
