<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class BadReferenceException.
 */
class BadReferenceException extends VerifyException
{
    /**
     * BadReferenceException constructor.
     */
    public function __construct(string $reference = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_BAD_REFERENCE_FORMAT[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_BAD_REFERENCE_FORMAT[AppConstants::MESSAGE],
                $reference,
                $_ENV['REFERENCE_REGEX']
            ),
        ]);
    }
}
