<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;

/**
 * Class GeneralException.
 */
class GeneralException extends \RuntimeException
{
    /**
     * GeneralException constructor.
     */
    public function __construct(array $exceptionDetail, string $message = null, int $code = null)
    {
        $messageException = $message ?? $exceptionDetail[AppConstants::MESSAGE];
        $codeException = $code ?? $exceptionDetail[AppConstants::CODE];

        parent::__construct($messageException, $codeException);
    }

    /**
     * setMessage.
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
