<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class BalanceApplicationException.
 */
class BalanceApplicationException extends PaymentException
{
    /**
     * BalanceApplicationException constructor.
     */
    public function __construct(string $errorCode, string $message)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::BALANCE_APPLICATION_ERROR[AppConstants::CODE],
                $_ENV['APP_CODE'],
                $errorCode
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::BALANCE_APPLICATION_ERROR[AppConstants::MESSAGE],
                $message
            ),
        ]);
    }
}
