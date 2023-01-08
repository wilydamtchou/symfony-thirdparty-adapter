<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class ParameterEnvNotFoundException.
 */
class ParameterEnvNotFoundException extends GeneralException
{
    /**
     * ParameterEnvNotFoundException constructor.
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        parent::__construct(SystemExceptionMessage::PARAMETER_NOT_FOUND, $message, SystemExceptionMessage::PARAMETER_NOT_FOUND[AppConstants::CODE]);
    }
}
