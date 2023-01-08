<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\IllegalStatusCancelException;

interface CancelService
{
    /**
     *@throws IllegalStatusCancelException
     */
    public function cancel(int $transactionId): Transaction;
}
