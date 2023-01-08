<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Parameter;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ParameterEnvNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ParameterNotFoundException;

interface ParameterService
{
    /**
     * @throws ParameterNotFoundException
     */
    public function get(string $key, bool $throw = true): ?string;

    /**
     * @throws ParameterEnvNotFoundException
     */
    public function getEnv(string $key, bool $throw = true): ?string;

    /**
     * @throws ParameterNotFoundException
     */
    public function getParameter(string $key, bool $throw = true): ?Parameter;

    /**
     * @throws \Exception
     */
    public function setParameter(string $key, string $value): void;
}
