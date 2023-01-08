<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class IllegalStatusCancelException.
 */
class IllegalStatusCancelException extends ConfirmException
{
    /**
     * BadPhoneException constructor.
     */
    public function __construct(int $transactionId, string $status)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::ILLEGAL_STATUS_CANCEL_EXCEPTION[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::ILLEGAL_STATUS_CANCEL_EXCEPTION[AppConstants::MESSAGE],
                $transactionId,
                $status
            ),
        ]);
    }
}
