<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

class Reference
{
    public string $reference;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
