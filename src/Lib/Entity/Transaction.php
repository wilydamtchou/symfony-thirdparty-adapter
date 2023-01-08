<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\BaseEntity;

/**
 * Transaction.
 */
class Transaction extends BaseEntity
{
    public int $id;
    public int $transactionId;
    public string $reference;
    public string $accountNumber;
    public string $accountName;
    public float $amount;
    public ?string $phone;
    public ?string $email;
    public ?string $option;
    public string $externalId;
    public string $requestId;
    public string $applicationId;
    public string $financialId;
    public ?string $providerId;
    public ?string $providerStatus;
    public ?string $providerDate;
    public ?string $providerMessage;
    public ?float $providerBalance;
    public ?Reference $referenceData;

    /**
     * void.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }
}
