<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

class SMS
{
    public string $sender;
    public string $phone;
    public string $message;
    public string $country;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
