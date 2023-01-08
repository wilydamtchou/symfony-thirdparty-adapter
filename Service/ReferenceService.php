<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Reference;
use Willydamtchou\SymfonyThirdpartyAdapter\Model\AppConstants as LocalAppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\ReferenceManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\Reference as ReferenceDTO;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\ReferenceApiResponse as BaseReferenceApiResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Reference as BaseReference;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ReferenceNotFoundException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\ReferenceApiResponseCollection;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\HttpService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\OptionService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService as BaseReferenceService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\UtilService;

class ReferenceService implements BaseReferenceService
{
    protected ReferenceManager $referenceManager;
    protected OptionService $optionService;
    protected HttpService $httpService;
    protected VerifyService $verifyService;
    protected UtilService $utilService;

    public function __construct(ReferenceManager $referenceManager, OptionService $optionService, HttpService $httpService, VerifyService $verifyService, UtilService $utilService)
    {
        $this->referenceManager = $referenceManager;
        $this->optionService = $optionService;
        $this->httpService = $httpService;
        $this->verifyService = $verifyService;
        $this->utilService = $utilService;
    }

    public function create(BaseReference $reference): Reference
    {
        $this->verifyService->verifyReferenceAPI();

        return $this->referenceManager->save($reference);
    }

    public function createWith(string $referenceNumber): Reference
    {
        $this->verifyService->verifyReferenceAPI();
        $this->verifyService->verifyReference($referenceNumber);

        $reference = new Reference();
        $reference->referenceNumber = $referenceNumber;

        return $this->referenceManager->save($reference);
    }

    /**
     * @throws \Exception
     */
    public function findByReferenceNumber(string $referenceNumber): Reference
    {
        $this->verifyService->verifyReferenceAPI();
        $this->verifyService->verifyReference($referenceNumber);

        $reference = $this->referenceManager->findOneByReferenceNumber($referenceNumber, false);

        if (!$reference) {
            $reference = $this->findByApi($referenceNumber);
            $reference = $this->referenceManager->save($reference);
        }

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_ENABLED'] && AppConstants::PARAMETER_TRUE_VALUE == $_ENV['SEARCH_OPTION_WITH_REFERENCE']) {
            $reference->options = $this->optionService->list($referenceNumber)->all();
        }

        return $reference;
    }

    /**
     * @throws \Exception
     */
    public function findByApi(string $referenceNumber): Reference
    {
        $dto = new ReferenceDTO();
        $dto->reference = $referenceNumber;
        $data = $this->httpService->sendGET($_ENV['API_REFERENCE'], $dto->toArray());
        $response = $this->generateReferenceResponse($referenceNumber, $_ENV['API_REFERENCE'], $data);

        $reference = new Reference();

        foreach (get_object_vars($response) as $key => $value) {
            if (property_exists($reference, $key) && null != $value) {
                $reference->$key = $value;
            }
        }

        $reference->generatedDate = $this->utilService->convertDateToGMT($response->generationDate, $_ENV['TIME_ZONE_PROVIDER']);
        $reference->expiratedDate = $this->utilService->convertDateToGMT($response->expirationDate, $_ENV['TIME_ZONE_PROVIDER']);
        $reference->expirationDate = $reference->expiratedDate->format($_ENV['API_DATE_FORMAT']);
        $reference->generationDate = $reference->generatedDate->format($_ENV['API_DATE_FORMAT']);
        $reference->billStatusDesc = LocalAppConstants::STATUS_TABLE[$reference->billStatus];

        return $reference;
    }

    /**
     * @throws \Exception
     */
    public function getAmount(string $referenceNumber): float
    {
        return $this->findByReferenceNumber($referenceNumber)->amount;
    }

    /**
     * @throws BadApiResponse|PaymentAPIException|BadApiResponse|ReferenceNotFoundException
     */
    public function generateReferenceResponse(string $referenceNumber, ?string $api, ?array $data): BaseReferenceApiResponse
    {
        $data = json_decode($data['result']);

        if (is_object($data)) {
            throw new ReferenceNotFoundException($referenceNumber);
        }

        $responseData = new ReferenceApiResponseCollection($data);
        $response = $responseData->first();

        foreach (LocalAppConstants::CONVERSION_RESULT_REFERENCE as $key => $value) {
            $response->$key = $response->$value;
        }

        return $response;
    }

    /**
     * @throws \Exception
     */
    public function updateStatus(string $referenceNumber, Status $status): Reference
    {
        return $this->referenceManager->updateStatus($referenceNumber, $status);
    }
}
