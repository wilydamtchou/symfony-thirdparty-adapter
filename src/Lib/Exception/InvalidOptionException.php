<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class InvalidOptionException.
 */
class InvalidOptionException extends VerifyException
{
    /**
     * InvalidOptionException constructor.
     */
    public function __construct(string $option = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_INVALID_OPTION_VALUE[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_INVALID_OPTION_VALUE[AppConstants::MESSAGE],
                $option
            ),
        ]);
    }
}
