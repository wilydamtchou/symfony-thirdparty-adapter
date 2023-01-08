<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class DuplicateTransactionIdException.
 */
class DuplicateTransactionIdException extends PaymentException
{
    /**
     * DuplicateTransactionIdException constructor.
     */
    public function __construct(string $transactionId = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_TRANSACTION_ID[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_TRANSACTION_ID[AppConstants::MESSAGE],
                $transactionId
            ),
        ]);
    }
}
