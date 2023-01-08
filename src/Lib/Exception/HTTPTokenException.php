<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class HTTPTokenException.
 */
class HTTPTokenException extends GeneralException
{
    /**
     * HTTPTokenException constructor.
     */
    public function __construct(string $api, string $message = null, string $code = null)
    {
        $text = sprintf(SystemExceptionMessage::HTTP_TOKEN_FAILURE[AppConstants::MESSAGE], $api);

        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::HTTP_TOKEN_FAILURE[AppConstants::CODE],
            AppConstants::MESSAGE => $text,
        ];

        parent::__construct($exceptionDetail, $message, $code);
    }
}
