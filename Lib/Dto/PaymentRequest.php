<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class PaymentRequest.
 */
class PaymentRequest extends VerifyRequest
{
    /**
     * @Serializer\Type("string")
     */
    public ?string $externalId = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $requestId = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $applicationId = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $financialId = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $accountNumber = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $accountName = null;
}
