<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class RequiredAccountNumberException.
 */
class RequiredAccountNumberException extends PaymentException
{
    /**
     * RequiredAccountNumberException constructor.
     */
    public function __construct()
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_REQUIRED_ACCOUNT_NUMBER[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => SystemExceptionMessage::PAYMENT_REQUIRED_ACCOUNT_NUMBER[AppConstants::MESSAGE],
        ]);
    }
}
