<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Dto;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ProviderPaymentResponse as BaseProviderPaymentResponse;

class ProviderPaymentResponse extends BaseProviderPaymentResponse
{
    /**
     * @Serializer\Type("string")
     */
    public ?string $txnDataMessage = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $txnDataStatus = null;
}
