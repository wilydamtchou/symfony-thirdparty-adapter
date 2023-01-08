<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\VerifyRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

interface CheckController
{
    public function verify(VerifyRequest $request): JsonResponse;
}
