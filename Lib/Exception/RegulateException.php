<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class RegulateException.
 */
class RegulateException extends PaymentException
{
    /**
     * RegulateException constructor.
     */
    public function __construct(string $message)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::REGULATE_FAILURE[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::REGULATE_FAILURE[AppConstants::MESSAGE],
                $message
            ),
        ]);
    }
}
