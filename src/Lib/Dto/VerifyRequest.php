<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class VerifyRequest.
 */
class VerifyRequest
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
    public ?string $phone = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $email = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $option = null;
}
