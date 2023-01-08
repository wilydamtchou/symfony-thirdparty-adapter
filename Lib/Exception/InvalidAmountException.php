<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class InvalidAmountException.
 */
class InvalidAmountException extends VerifyException
{
    /**
     * InvalidAmountException constructor.
     */
    public function __construct(float $amount = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_INVALID_AMOUNT_RANGE[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_INVALID_AMOUNT_RANGE[AppConstants::MESSAGE],
                $amount,
                $_ENV['AMOUNT_MIN'],
                $_ENV['AMOUNT_MAX']
            ),
        ]);
    }
}
