<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class GeneralNetworkException.
 */
class GeneralNetworkException extends GeneralException
{
    /**
     * GeneralNetworkException constructor.
     */
    public function __construct(string $api, string $message = null, string $code = null)
    {
        $text = sprintf(SystemExceptionMessage::GENERAL_NETWORK_FAILURE[AppConstants::MESSAGE], $api);

        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::GENERAL_NETWORK_FAILURE[AppConstants::CODE],
            AppConstants::MESSAGE => $text,
        ];

        parent::__construct($exceptionDetail, $message, $code);
    }
}
