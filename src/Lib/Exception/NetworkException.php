<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class NetworkException.
 */
class NetworkException extends GeneralException
{
    /**
     * NetworkException constructor.
     */
    public function __construct(string $api, string $message = null, string $code = null)
    {
        $text = sprintf(SystemExceptionMessage::NETWORK_FAILURE[AppConstants::MESSAGE], $api);

        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::NETWORK_FAILURE[AppConstants::CODE],
            AppConstants::MESSAGE => $text,
        ];

        parent::__construct($exceptionDetail, $message, $code);
    }
}
