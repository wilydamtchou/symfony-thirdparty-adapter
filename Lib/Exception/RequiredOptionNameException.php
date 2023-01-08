<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class RequiredOptionNameException.
 */
class RequiredOptionNameException extends OptionException
{
    /**
     * RequiredOptionNameException constructor.
     */
    public function __construct()
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::REQUIRED_OPTION_NAME[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => SystemExceptionMessage::REQUIRED_OPTION_NAME[AppConstants::MESSAGE],
        ]);
    }
}
