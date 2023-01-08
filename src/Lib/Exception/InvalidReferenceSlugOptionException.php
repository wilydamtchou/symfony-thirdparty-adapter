<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class InvalidReferenceSlugOptionException.
 */
class InvalidReferenceSlugOptionException extends VerifyException
{
    /**
     * InvalidReferenceSlugOptionException constructor.
     */
    public function __construct(string $reference, string $slug)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::OPTION_REFERENCE_SLUG_NOT_FOUND[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::OPTION_REFERENCE_SLUG_NOT_FOUND[AppConstants::MESSAGE],
                $slug,
                $reference
            ),
        ]);
    }
}
