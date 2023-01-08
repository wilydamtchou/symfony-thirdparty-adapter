<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class PaymentApplicationException.
 */
class PaymentApplicationException extends PaymentException
{
    /**
     * PaymentApplicationException constructor.
     */
    public function __construct(string $errorCode, string $message)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_APPLICATION_ERROR[AppConstants::CODE],
                $_ENV['APP_CODE'],
                $errorCode
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_APPLICATION_ERROR[AppConstants::MESSAGE],
                $message
            ),
        ]);
    }
}
