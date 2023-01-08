<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

interface BalanceController
{
    public function balance(): JsonResponse;
}
