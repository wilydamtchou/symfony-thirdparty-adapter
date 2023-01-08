<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\StatusRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;

interface StatusService
{
    public function status(StatusRequest $request): Transaction;
    public function generateResponse(Transaction $transaction, bool $withRef = true): PaymentResponse;
}
