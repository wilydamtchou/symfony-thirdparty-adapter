<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class ReferencePaidException.
 */
class ReferencePaidException extends ReferenceException
{
    /**
     * ReferencePaidException constructor.
     */
    public function __construct(string $reference, string $date)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::REFERENCE_ALREADY_PAID[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::REFERENCE_ALREADY_PAID[AppConstants::MESSAGE],
                $reference,
                $date
            ),
        ]);
    }
}
