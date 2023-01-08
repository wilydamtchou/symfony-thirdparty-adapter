<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class DuplicateRequestIdException.
 */
class DuplicateRequestIdException extends PaymentException
{
    /**
     * DuplicateRequestIdException constructor.
     */
    public function __construct(string $requestId = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_REQUEST_ID[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_REQUEST_ID[AppConstants::MESSAGE],
                $requestId
            ),
        ]);
    }
}
