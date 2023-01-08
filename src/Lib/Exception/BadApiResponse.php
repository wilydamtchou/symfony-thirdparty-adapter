<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class BadApiResponse.
 */
class BadApiResponse extends GeneralException
{
    /**
     * NetworkException constructor.
     */
    public function __construct(string $api, string $message = null, string $code = null)
    {
        $text = sprintf(SystemExceptionMessage::BAD_API_RESPONSE[AppConstants::MESSAGE], $api);

        $exceptionDetail = [
            AppConstants::CODE => SystemExceptionMessage::BAD_API_RESPONSE[AppConstants::CODE],
            AppConstants::MESSAGE => $text,
        ];

        parent::__construct($exceptionDetail);
    }
}
