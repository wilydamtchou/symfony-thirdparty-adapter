<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;

interface PaymentProcessService
{
    /**
     * @throws NetworkException|GeneralNetworkException
     */
    public function payment(Transaction $transaction): array;

    public function generateProviderPaymentResponse(?array $paymentResult): ProviderPaymentResponse;

    /**
     * @throws PaymentAPIException
     */
    public function decision(ProviderPaymentResponse $response): void;
}
