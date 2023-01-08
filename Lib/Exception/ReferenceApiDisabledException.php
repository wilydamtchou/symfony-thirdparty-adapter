<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class ReferenceApiDisabledException.
 */
class ReferenceApiDisabledException extends OptionException
{
    /**
     * ReferenceApiDisabledException constructor.
     */
    public function __construct()
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::REFERENCE_API_DISABLED[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => SystemExceptionMessage::REFERENCE_API_DISABLED[AppConstants::MESSAGE],
        ]);
    }
}
