<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class DuplicateApplicationIdException.
 */
class DuplicateApplicationIdException extends PaymentException
{
    /**
     * DuplicateApplicationIdException constructor.
     */
    public function __construct(string $applicationId = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_APPLICATION_ID[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_APPLICATION_ID[AppConstants::MESSAGE],
                $applicationId
            ),
        ]);
    }
}
