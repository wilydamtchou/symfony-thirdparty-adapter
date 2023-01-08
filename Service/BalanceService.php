<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BalanceApiDisabledException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BalanceApplicationException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\BalanceService as BaseBalanceService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ParameterService;

class BalanceService implements BaseBalanceService
{
    protected ParameterService $parameterService;

    public function __construct(ParameterService $parameterService)
    {
        $this->parameterService = $parameterService;
    }

    /**
     * @throws BalanceApplicationException
     */
    public function balance(): float
    {
        throw new BalanceApiDisabledException();
    }

    /**
     * @throws BalanceApplicationException|\Exception
     */
    public function setBalance(float $balance): void
    {
        $this->parameterService->setParameter(AppConstants::BALANCE, $balance);
    }
}
