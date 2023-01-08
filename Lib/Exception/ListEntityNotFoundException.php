<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class ListEntityNotFoundException.
 */
class ListEntityNotFoundException extends GeneralException
{
    /**
     * ListEntityNotFoundException constructor.
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        parent::__construct(SystemExceptionMessage::LIST_ENTITY_NOT_FOUND, $message, SystemExceptionMessage::LIST_ENTITY_NOT_FOUND[AppConstants::CODE]);
    }
}
