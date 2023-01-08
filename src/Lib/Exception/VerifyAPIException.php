<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class VerifyAPIException.
 */
class VerifyAPIException extends VerifyException
{
    /**
     * VerifyAPIException constructor.
     */
    public function __construct(int $errorCode, string $message)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_APPLICATION_ERROR[AppConstants::CODE],
                $_ENV['APP_CODE'],
                $errorCode
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_APPLICATION_ERROR[AppConstants::MESSAGE],
                $message
            ),
        ]);
    }
}
