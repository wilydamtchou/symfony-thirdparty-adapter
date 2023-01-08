<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class VerifyApplicationException.
 */
class VerifyApplicationException extends VerifyException
{
    /**
     * VerifyApplicationException constructor.
     */
    public function __construct(string $errorCode, string $message)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_API_ERROR[AppConstants::CODE],
                $_ENV['APP_CODE'],
                $errorCode
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_API_ERROR[AppConstants::MESSAGE],
                $message
            ),
        ]);
    }
}
