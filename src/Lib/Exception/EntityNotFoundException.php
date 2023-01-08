<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;

/**
 * Class EntityNotFoundException.
 */
class EntityNotFoundException extends GeneralException
{
    /**
     * EntityNotFoundException constructor.
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        parent::__construct(SystemExceptionMessage::ENTITY_NOT_FOUND, $message, SystemExceptionMessage::ENTITY_NOT_FOUND[AppConstants::CODE]);
    }
}
