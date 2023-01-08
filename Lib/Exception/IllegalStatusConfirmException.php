<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class IllegalStatusConfirmException.
 */
class IllegalStatusConfirmException extends ConfirmException
{
    /**
     * BadPhoneException constructor.
     */
    public function __construct(int $transactionId, string $status)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::ILLEGAL_STATUS_CONFIRM_EXCEPTION[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::ILLEGAL_STATUS_CONFIRM_EXCEPTION[AppConstants::MESSAGE],
                $transactionId,
                $status
            ),
        ]);
    }
}
