<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentApplicationException;

interface PaymentSuccessService
{
    /**
     * @throws PaymentApplicationException
     */
    public function success(Transaction $transaction, ProviderPaymentResponse $response): Transaction;

    public function verifyAfterPayment(Transaction $transaction, ProviderPaymentResponse $response): void;

    public function setBalance(Transaction $transaction): void;
}
