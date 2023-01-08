<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class EntityAlReadyExistException.
 */
class EntityAlReadyExistException extends GeneralException
{
    /**
     * EntityNotFoundException constructor.
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        parent::__construct(SystemExceptionMessage::ENTITY_ALREADY_EXIST, $message, SystemExceptionMessage::ENTITY_ALREADY_EXIST[AppConstants::CODE]);
    }
}
