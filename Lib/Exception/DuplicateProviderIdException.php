<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class DuplicateProviderIdException.
 */
class DuplicateProviderIdException extends PaymentException
{
    /**
     * DuplicateProviderIdException constructor.
     */
    public function __construct(string $providerId = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_PROVIDER_ID[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_PROVIDER_ID[AppConstants::MESSAGE],
                $providerId
            ),
        ]);
    }
}
