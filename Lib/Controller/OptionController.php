<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\OptionRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

interface OptionController
{
    public function create(OptionRequest $request): JsonResponse;
    public function list(): JsonResponse;
}
