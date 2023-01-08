<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class RequiredRequestIdException.
 */
class RequiredRequestIdException extends PaymentException
{
    /**
     * RequiredRequestIdException constructor.
     */
    public function __construct()
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_REQUIRED_REQUEST_ID[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => SystemExceptionMessage::PAYMENT_REQUIRED_REQUEST_ID[AppConstants::MESSAGE],
        ]);
    }
}
