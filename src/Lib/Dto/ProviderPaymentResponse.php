<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ProviderPaymentResponse.
 */
class ProviderPaymentResponse
{
    /**
     * @Serializer\Type("string")
     */
    public ?string $transactionId = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $providerId = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $providerStatus = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $providerMessage = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $providerDate = null;

    /**
     * @Serializer\Type("float")
     */
    public ?float $providerBalance = null;
}
