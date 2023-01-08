<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\PaymentResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\StatusRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadReferenceException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\InvalidAmountException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\StatusService as BaseStatusService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;

class StatusService implements BaseStatusService
{
    private TransactionService $transactionService;
    private ReferenceService $referenceService;

    public function __construct(TransactionService $transactionService, ReferenceService $referenceService)
    {
        $this->transactionService = $transactionService;
        $this->referenceService = $referenceService;
    }

    public function status(StatusRequest $request): Transaction
    {
        if (!preg_match($_ENV['REFERENCE_REGEX'], $request->reference)) {
            throw new BadReferenceException($request->reference);
        }

        if ($request->amount && ($request->amount > $_ENV['AMOUNT_MAX'] || $request->amount < $_ENV['AMOUNT_MIN'])) {
            throw new InvalidAmountException($request->amount);
        }

        $searchItems = [];

        foreach (get_object_vars($request) as $key => $value) {
            if ($value) {
                $searchItems[$key] = $value;
            }
        }

        $transaction = $this->transactionService->findOneBy($searchItems);

        if ($_ENV['REFERENCE_API_ENABLED']) {
            $transaction->referenceData = $this->referenceService->findByReferenceNumber($transaction->reference);
        }

        return $transaction;
    }

    public function generateResponse(BaseTransaction $transaction, bool $withRef = true): PaymentResponse
    {
        $response = new PaymentResponse();

        if ($withRef && $_ENV['REFERENCE_API_ENABLED']) {
            $transaction->referenceData = $this->referenceService->findByReferenceNumber($transaction->reference);
        }

        if ($_ENV['REFERENCE_API_ENABLED'] && $transaction->referenceData) {
            unset($transaction->referenceData->generatedDate);
            unset($transaction->referenceData->expiratedDate);
            unset($transaction->referenceData->createdDate);
            unset($transaction->referenceData->lastUpdatedDate);
        }

        $response->referenceData = clone $transaction->referenceData;

        unset($transaction->id);
        unset($transaction->createdDate);
        unset($transaction->lastUpdatedDate);
        unset($transaction->referenceData);

        $response->result = $transaction;

        $response->transactionId = $transaction->transactionId;
        $response->providerId = $transaction->providerId;
        $response->requestId = $transaction->requestId;
        $response->financialId = $transaction->financialId;
        $response->externalId = $transaction->externalId;
        $response->applicationId = $transaction->applicationId;

        return $response;
    }
}
