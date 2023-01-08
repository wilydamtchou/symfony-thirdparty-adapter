<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class EmailApiDisabled.
 */
class EmailApiDisabled extends PaymentException
{
    /**
     * EmailApiDisabled constructor.
     */
    public function __construct()
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::EMAIL_API_DISABLED[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => SystemExceptionMessage::EMAIL_API_DISABLED[AppConstants::MESSAGE],
        ]);
    }
}
