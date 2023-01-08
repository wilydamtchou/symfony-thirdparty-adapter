<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceApiResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Reference;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;

interface ReferenceService
{
    public function create(Reference $reference): Reference;
    public function createWith(string $referenceNumber): Reference;
    public function findByReferenceNumber(string $referenceNumber): Reference;
    public function findByApi(string $referenceNumber): Reference;

    /**
     * @throws BadApiResponse|PaymentAPIException|BadApiResponse|ReferenceNotFoundException
     */
    public function generateReferenceResponse(string $referenceNumber, ?string $api, ?array $data): ReferenceApiResponse;

    /**
     * @throws \Exception
     */
    public function getAmount(string $referenceNumber): float;

    /**
     * @throws \Exception
     */
    public function updateStatus(string $referenceNumber, Status $status): Reference;
}
