<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class PaymentRequest.
 */
class OptionRequest
{
    /**
     * @Serializer\Type("string")
     */
    public ?string $name = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $slug = null;

    /**
     * @Serializer\Type("float")
     */
    public ?float $amount = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $reference = null;
}
