<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Parameter;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\ParameterManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ParameterEnvNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ParameterNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ParameterService as BaseParameterService;

class ParameterService implements BaseParameterService
{
    protected ParameterManager $parameterManager;

    public function __construct(ParameterManager $parameterManager)
    {
        $this->parameterManager = $parameterManager;
    }

    /**
     * @throws ParameterNotFoundException
     */
    public function get(string $key, bool $throw = true): ?string
    {
        $parameter = $this->parameterManager->findOneBySlug($key, $throw);

        return $parameter?->value;
    }

    /**
     * @throws ParameterEnvNotFoundException
     */
    public function getEnv(string $key, bool $throw = true): ?string
    {
        $parameter = null;
        if (!array_key_exists($key, $_ENV) || !$_ENV[$key]) {
            if ($throw) {
                throw new ParameterEnvNotFoundException($key);
            }
        } else {
            $parameter = $_ENV[$key];
        }

        return $parameter;
    }

    /**
     * @throws ParameterNotFoundException
     */
    public function getParameter(string $key, bool $throw = true): ?Parameter
    {
        return $this->parameterManager->findOneBySlug($key, $throw);
    }

    /**
     * @throws \Exception
     */
    public function setParameter(string $key, string $value): void
    {
        $parameter = $this->getParameter($key, false);

        if (!$parameter) {
            $parameter = new Parameter();
            $parameter->slug = $key;
            $parameter->name = ucfirst($key);
            $parameter->value = $value;
            $this->parameterManager->save($parameter);
        } else {
            $parameter->value = $value;
            $this->parameterManager->update($parameter);
        }
    }
}
