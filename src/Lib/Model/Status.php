<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

enum Status: string
{
    case PENDING = 'PENDING';
    case PROGRESS = 'PROGRESS';
    case SUCCESS = 'SUCCESS';
    case ENABLED = 'ENABLED';
    case FAILED = 'FAILED';
    case CANCELED = 'CANCELED';
}
