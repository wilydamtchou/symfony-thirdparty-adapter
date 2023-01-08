<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

interface CancelController
{
    public function cancel(int $transactionId): JsonResponse;
}
