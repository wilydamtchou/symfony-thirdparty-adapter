<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ReferenceApiResponse.
 */
class ReferenceApiResponse
{
    /**
     * @Serializer\Type("string")
     */
    public ?string $referenceNumber = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $generationDate = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $expirationDate = null;

    /**
     * @Serializer\Type("float")
     */
    public ?string $amount = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $name = null;
}
