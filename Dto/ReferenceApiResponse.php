<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Dto;

use JMS\Serializer\Annotation as Serializer;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceApiResponse as BaseReferenceApiResponse;

/**
 * Class ReferenceApiResponse.
 */
class ReferenceApiResponse extends BaseReferenceApiResponse
{
    /**
     * @Serializer\Type("string")
     */
    public ?string $customerId = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $billType = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $ref4 = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $billId = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $meterNumber = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $billStatus = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $billTypeDesc = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $agence = null;
}
