<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;

interface PaymentService
{
    /**
     * pay.
     *
     * @throws \Throwable
     */
    public function pay(PaymentRequest $request): Transaction;
}
