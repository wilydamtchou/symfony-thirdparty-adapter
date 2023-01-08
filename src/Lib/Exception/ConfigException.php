<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class ConfigException.
 */
class ConfigException extends GeneralException
{
    /**
     * ConfigException constructor.
     */
    public function __construct()
    {
        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::CONFIG_NOT_AUTHORIZED[AppConstants::CODE],
            AppConstants::MESSAGE => SystemExceptionMessage::CONFIG_NOT_AUTHORIZED[AppConstants::MESSAGE],
        ];

        parent::__construct($exceptionDetail);
    }
}
