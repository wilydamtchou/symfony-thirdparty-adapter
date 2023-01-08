<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Reference;

class PaymentResponse
{
    public int $code;
    public string $message;
    public ?Transaction $result;
    public ?Reference $referenceData;
    public ?string $externalId;
    public ?string $requestId;
    public ?string $applicationId;
    public ?string $financialId;
    public ?string $providerId = null;
    public ?int $transactionId;

}
