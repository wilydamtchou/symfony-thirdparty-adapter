<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\StatusRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

interface StatusController
{
    public function status(StatusRequest $request): JsonResponse;
}
