<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class DuplicateExternalIdException.
 */
class DuplicateExternalIdException extends PaymentException
{
    /**
     * DuplicateExternalIdException constructor.
     */
    public function __construct(string $externalId = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_EXTERNAL_ID[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_EXTERNAL_ID[AppConstants::MESSAGE],
                $externalId
            ),
        ]);
    }
}
