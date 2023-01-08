<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

interface ReferenceController
{
    public function listReference(string $reference): JsonResponse;
    public function reference(string $reference): JsonResponse;
}
