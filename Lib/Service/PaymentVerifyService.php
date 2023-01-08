<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentException;

interface PaymentVerifyService
{
    /**
     * @throws PaymentException
     */
    public function verify(PaymentRequest $paymentRequest): void;
}
