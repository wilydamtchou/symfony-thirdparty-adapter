<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class RequiredOptionAmountException.
 */
class RequiredOptionAmountException extends OptionException
{
    /**
     * RequiredOptionAmountException constructor.
     */
    public function __construct()
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::REQUIRED_OPTION_AMOUNT[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => SystemExceptionMessage::REQUIRED_OPTION_AMOUNT[AppConstants::MESSAGE],
        ]);
    }
}
