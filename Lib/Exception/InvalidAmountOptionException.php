<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class InvalidAmountOptionException.
 */
class InvalidAmountOptionException extends VerifyException
{
    /**
     * InvalidAmountOptionException constructor.
     */
    public function __construct(string $option, float $amount)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_INVALID_OPTION_AMOUNT_VALUE[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_INVALID_OPTION_AMOUNT_VALUE[AppConstants::MESSAGE],
                $option,
                $amount
            ),
        ]);
    }
}
