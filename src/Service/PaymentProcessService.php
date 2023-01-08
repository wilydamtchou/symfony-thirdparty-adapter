<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Dto\ProviderPaymentResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Model\AppConstants as LocalAppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse as BaseProviderPaymentResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\HttpService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\PaymentProcessService as BasePaymentProcessService;

class PaymentProcessService implements BasePaymentProcessService
{
    private HttpService $httpService;

    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
    }

    /**
     * @throws \Exception
     */
    public function payment(BaseTransaction $transaction): array
    {
        $response = null;

        if ($_ENV['API_PAYMENT'] && $_ENV['API_TOKEN']) {
            $response = $this->httpService->sendPOSTWithToken($_ENV['API_PAYMENT'], $transaction->toArray(), []);
        } elseif ($_ENV['API_PAYMENT']) {
            $response = $this->httpService->sendPOST($_ENV['API_PAYMENT'], $transaction->toArray());
        }

        return $response;
    }

    public function generateProviderPaymentResponse(?array $paymentResult): ProviderPaymentResponse
    {
        $response = new ProviderPaymentResponse();

        $response->providerStatus = $paymentResult[LocalAppConstants::API_CODE];
        $response->providerMessage = $paymentResult[LocalAppConstants::API_DATA_MESSAGE];
        if ($paymentResult[LocalAppConstants::API_DATA]) {
            $response->providerId = $paymentResult[LocalAppConstants::API_DATA][LocalAppConstants::API_DATA_TRANSACTION_ID];
            $response->txnDataStatus = $paymentResult[LocalAppConstants::API_DATA][LocalAppConstants::API_DATA_STATUS];
            $response->txnDataMessage = $paymentResult[LocalAppConstants::API_DATA][LocalAppConstants::API_DATA_MESSAGE];
        }

        return $response;
    }

    /**
     * @throws PaymentAPIException
     */
    public function decision(BaseProviderPaymentResponse $response): void
    {
        if (LocalAppConstants::API_SUCCESS_CODE != $response->providerStatus || !$response->providerId) {
            throw new PaymentAPIException($response->providerStatus, $response->providerMessage);
        }
    }
}
