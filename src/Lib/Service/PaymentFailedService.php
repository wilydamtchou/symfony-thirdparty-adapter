<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;

interface PaymentFailedService
{
    public function failed(PaymentAPIException $exception, Transaction $transaction): PaymentAPIException;
}
