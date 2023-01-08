<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

class Email
{
    public string $sender;
    public string $object;
    public string $email;
    public string $message;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
