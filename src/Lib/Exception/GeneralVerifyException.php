<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class GeneralVerifyException.
 */
class GeneralVerifyException extends VerifyException
{
    /**
     * GeneralVerifyException constructor.
     */
    public function __construct(string $message = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_GENERAL_FAILURE[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_GENERAL_FAILURE[AppConstants::MESSAGE],
                $message
            ),
        ]);
    }
}
