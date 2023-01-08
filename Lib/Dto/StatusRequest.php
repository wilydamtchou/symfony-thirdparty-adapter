<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class StatusRequest.
 */
class StatusRequest
{
    /**
     * @Serializer\Type("string")
     */
    public ?string $reference = null;

    /**
     * @Serializer\Type("float")
     */
    public ?float $amount = null;

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
    public ?string $providerId = null;

    /**
     * @Serializer\Type("int")
     */
    public ?int $transactionId = null;
}
