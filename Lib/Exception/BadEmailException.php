<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class BadEmailException.
 */
class BadEmailException extends VerifyException
{
    /**
     * BadEmailException constructor.
     */
    public function __construct(string $email = null)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::VERIFY_BAD_EMAIL_FORMAT[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::VERIFY_BAD_EMAIL_FORMAT[AppConstants::MESSAGE],
                $email
            ),
        ]);
    }
}
