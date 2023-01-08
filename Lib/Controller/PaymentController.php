<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

interface PaymentController
{
    public function pay(PaymentRequest $request): JsonResponse;
}
