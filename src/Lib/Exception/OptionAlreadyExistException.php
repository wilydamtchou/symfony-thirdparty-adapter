<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class OptionAlreadyExistException.
 */
class OptionAlreadyExistException extends OptionException
{
    /**
     * OptionAlreadyExistException constructor.
     */
    public function __construct(string $slug)
    {
        parent::__construct([
            AppConstants::CODE => sprintf(
                SystemExceptionMessage::OPTION_ALREADY_EXIST[AppConstants::CODE],
                $_ENV['APP_CODE']
            ),
            AppConstants::MESSAGE => sprintf(
                SystemExceptionMessage::OPTION_ALREADY_EXIST[AppConstants::MESSAGE],
                $slug
            ),
        ]);
    }
}
