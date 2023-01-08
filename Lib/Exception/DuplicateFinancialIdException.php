<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class DuplicateFinancialIdException.
 */
class DuplicateFinancialIdException extends PaymentException
{
    /**
     * DuplicateFinancialIdException constructor.
     */
    public function __construct(string $financialId = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_FINANCIAL_ID[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::PAYMENT_DUPLICATE_FINANCIAL_ID[AppConstants::MESSAGE],
                $financialId
            ),
        ]);
    }
}
