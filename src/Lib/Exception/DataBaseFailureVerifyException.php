<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class DataBaseFailureVerifyException.
 */
class DataBaseFailureVerifyException extends VerifyException
{
    /**
     * DataBaseFailureVerifyException constructor.
     */
    public function __construct()
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_DATABASE_FAILURE[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => SystemExceptionMessage::VERIFY_DATABASE_FAILURE[AppConstants::MESSAGE],
        ]);
    }
}
