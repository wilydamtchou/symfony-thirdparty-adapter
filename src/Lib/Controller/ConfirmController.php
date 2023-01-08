<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

interface ConfirmController
{
    public function confirm(int $transactionId): JsonResponse;
}
