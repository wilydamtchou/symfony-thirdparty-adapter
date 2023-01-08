<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BalanceApplicationException;

interface BalanceService
{
    /**
     * @throws BalanceApplicationException
     */
    public function balance(): float;

    public function setBalance(float $balance): void;
}
