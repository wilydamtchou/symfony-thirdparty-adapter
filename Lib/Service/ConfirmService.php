<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\IllegalStatusConfirmException;

interface ConfirmService
{
    /**
     *@throws IllegalStatusConfirmException
     */
    public function confirm(int $transactionId): Transaction;
}
