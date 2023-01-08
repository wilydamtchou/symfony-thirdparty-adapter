<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class PaymentAPIException.
 */
class PaymentAPIException extends PaymentException
{
    /**
     * PaymentAPIException constructor.
     */
    public function __construct(int $errorCode, string $message)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_API_EXCEPTION[AppConstants::CODE],
                $_ENV['APP_CODE'],
                $errorCode
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_API_EXCEPTION[AppConstants::MESSAGE],
                $message
            ),
        ]);
    }
}
