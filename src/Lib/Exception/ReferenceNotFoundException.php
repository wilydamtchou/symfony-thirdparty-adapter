<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class ReferenceNotFoundException.
 */
class ReferenceNotFoundException extends ReferenceException
{
    /**
     * ReferenceNotFoundException constructor.
     */
    public function __construct(string $reference = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::REFERENCE_NOT_FOUND[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::REFERENCE_NOT_FOUND[AppConstants::MESSAGE],
                $reference
            ),
        ]);
    }
}
