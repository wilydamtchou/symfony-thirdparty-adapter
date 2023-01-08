<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\RegulateException;

interface PaymentErrorService
{
    public function error(\Throwable $exception, Transaction $transaction): RegulateException;
}
