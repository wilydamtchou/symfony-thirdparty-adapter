<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class BadPhoneException.
 */
class BadPhoneException extends VerifyException
{
    /**
     * BadPhoneException constructor.
     */
    public function __construct(string $phone = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_BAD_PHONE_FORMAT[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_BAD_PHONE_FORMAT[AppConstants::MESSAGE],
                $phone,
                $_ENV['PHONE_REGEX']
            ),
        ]);
    }
}
