<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * Class ApplicationExceptionMessage.
 */
final class ApplicationExceptionMessage
{
    public const ILLEGAL_TRANSACTION_STATUS = [AppConstants::CODE => '001', AppConstants::MESSAGE => 'Illegal transaction status %s. The status must be PROGRESS or PENDING'];
    public const TRANSACTION_ID_MISMATCH = [AppConstants::CODE => '002', AppConstants::MESSAGE => 'Transaction Id in adapter side %s and Provider side %s are mismatched'];
    public const TRANSACTION_REFERENCE_MISMATCH = [AppConstants::CODE => '003', AppConstants::MESSAGE => 'Transaction Reference in adapter side %s and Provider side %s are mismatched'];
    public const PARAM_BALANCE_NOT_FOUND = [AppConstants::CODE => '004', AppConstants::MESSAGE => 'Parameter balance not found. Check configuration'];
}