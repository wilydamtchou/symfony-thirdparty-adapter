<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

interface RegulateController
{
    public function regulate(int $transactionId): JsonResponse;
}
