<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class RequiredAccountNameException.
 */
class RequiredAccountNameException extends PaymentException
{
    /**
     * RequiredAccountNameException constructor.
     */
    public function __construct()
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_REQUIRED_ACCOUNT_NAME[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => SystemExceptionMessage::PAYMENT_REQUIRED_ACCOUNT_NAME[AppConstants::MESSAGE],
        ]);
    }
}
