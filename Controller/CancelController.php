<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Controller;

use Willydamtchou\SymfonyThirdpartyAdapter\Service\CancelService;
use Willydamtchou\SymfonyThirdpartyAdapter\Service\StatusService;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller\CancelController as BaseCancelController;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CancelController.
 */
#[Route('/api')]
class CancelController extends AbstractController implements BaseCancelController
{
    protected CancelService $cancelService;
    protected StatusService $statusService;

    public function __construct(CancelService $cancelService, StatusService $statusService)
    {
        $this->statusService = $statusService;
        $this->cancelService = $cancelService;
    }

    /**
     * Cancel API.
     *
     * This call takes to cancel a transaction.
     *
     * @Post("/cancel/{transactionId}")
     * @OA\Post(
     *   path="/api/cancel/{transactionId}",
     *   tags={"Cancel"},
     *   summary="Cancel API",
     *   description="API is used to cancel a transaction",
     *   operationId="cancel",
     *   @OA\Parameter(
     *          name="transactionId",
     *          in="path",
     *          required=true,
     *          description="The transactionId of the transaction",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          example="455435435435345",
     *   ),
     *  @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="code",
     *                         type="integer",
     *                         description="code of response"
     *                     ),
     *                     @OA\Property(
     *                         property="message",
     *                         type="string",
     *                         description="message of response"
     *                     ),
     *                     @OA\Property(
     *                         property="result",
     *                         type="mixed",
     *                         description="Result of response"
     *                     ),
     *                     @OA\Property(
     *                         property="referenceData",
     *                         type="mixed",
     *                         description="Informations about reference"
     *                     ),
     *                     @OA\Property(
     *                         property="externalId",
     *                         type="integer",
     *                         description="externalId"
     *                     ),
     *                     @OA\Property(
     *                         property="requestId",
     *                         type="string",
     *                         description="requestId"
     *                     ),
     *                     @OA\Property(
     *                         property="applicationId",
     *                         type="string",
     *                         description="applicationId"
     *                     ),
     *                     @OA\Property(
     *                         property="financialId",
     *                         type="string",
     *                         description="financialId"
     *                     ),
     *                     @OA\Property(
     *                         property="providerId",
     *                         type="string",
     *                         description="providerId"
     *                     ),
     *                     @OA\Property(
     *                         property="transactionId",
     *                         type="integer",
     *                         description="transactionId"
     *                     ),
     *                     example={
     *                         "code": 200,
     *                         "message": "success",
     *                         "referenceData": {},
     *                         "result": {},
     *                         "externalId": "AFP1223r23",
     *                         "requestId": "455454545454",
     *                         "applicationId": "OSS-1311313131",
     *                         "financialId": "1413434244",
     *                         "providerId": "3254545452",
     *                         "transactionId": 4424543454534
     *                      }
     *                 )
     *             )
     *         }
     *     ),
     *   @OA\Response(response="500",description="General Failure (error)"),
     *   @OA\Response(response="501",description="Network Failure on API (api)"),
     *   @OA\Response(response="504",description="Bad API Response format on API (api)"),
     *   @OA\Response(response="505",description="Database Connectivity failure"),
     *   @OA\Response(response="506",description="General Network Failure on API (api)"),
     *   @OA\Response(response="507",description="Configuration view is disabled. Contact support"),
     *   @OA\Response(response="404",description="URI Not found"),
     *   @OA\Response(response="50508003",description="An error occured after the payment (error). Transaction must be regulated"),
     *   @OA\Response(response="50508004",description="SMS API is disabled"),
     *   @OA\Response(response="50508005",description="Email API is disabled"),
     *   @OA\Response(response="405",description="(entity) with (field) (value) not found"),
     *   @OA\Response(response="406",description="(entity) with (field) (value) already exist"),
     *   @OA\Response(response="407",description="No (entity) found"),
     *   @OA\Response(response="408",description="Parameter (key) not found, verify configuration"),
     *   @OA\Response(response="409",description="Environment parameter (key) must be specified, verify configuration"),
     *   @OA\Response(response="50108000",description="General failure (error)"),
     *   @OA\Response(response="50108001",description="Database connectivity error"),
     *   @OA\Response(response="40108001",description="Bad reference (reference) format (format)"),
     *   @OA\Response(response="40108002",description="Invalid amount (amount) range [(amountmin) - (amountmin)]"),
     *   @OA\Response(response="40108003",description="Bad Phone (phone) format (format)"),
     *   @OA\Response(response="40108004",description="Bad Email (email) format (format)"),
     *   @OA\Response(response="40108005",description="Invalid Option (option) value"),
     *   @OA\Response(response="40108006",description="Invalid Option (option) Amount (amount) value"),
     *   @OA\Response(response="40208002",description="Reference (reference) not found"),
     *   @OA\Response(response="40208003",description="Reference (reference) has already been paid on (date)"),
     *   @OA\Response(response="30308",description="Verify Application error : (error)"),
     *   @OA\Response(response="10108",description="API error : (error)"),
     *   @OA\Response(response="30508",description="Payment Application error : (error)"),
     *   @OA\Response(response="31008",description="Balance Application error (error)"),
     *   @OA\Response(response="40508006",description="Financial Id is required"),
     *   @OA\Response(response="40508007",description="Duplicate ExternalId (externalId)"),
     *   @OA\Response(response="40508008",description="Duplicate RequestId (requestId)"),
     *   @OA\Response(response="40508009",description="Duplicate ApplicationId (applicationId)"),
     *   @OA\Response(response="40508010",description="Duplicate FinancialId (financialId)"),
     *   @OA\Response(response="40508011",description="Duplicate ProviderId (providerId)"),
     *   @OA\Response(response="40508012",description="Duplicate TransactionId (transactionId)"),
     *   @OA\Response(response="40508013",description="ExternalId is required"),
     *   @OA\Response(response="40508014",description="RequestId is required"),
     *   @OA\Response(response="40508015",description="ApplicationId is required"),
     *   @OA\Response(response="40508016",description="Account Number is required"),
     *   @OA\Response(response="40508017",description="Account Name is required"),
     *   @OA\Response(response="40808004",description="Transaction with transactionId (transactionId) could not be confirmed in status (status)"),
     *   @OA\Response(response="40808005",description="Transaction with transactionId (transactionId) could not be canceled in status (status)"),
     *   @OA\Response(response="10508",description="Payment API Exception : (error)"),
     *   @OA\Response(response="41108001",description="Option Name is required"),
     *   @OA\Response(response="41108002",description="Option Amount is required"),
     *   @OA\Response(response="41108003",description="The Option slug %s already exist"),
     *   @OA\Response(response="41108004",description="The Api Option is disabled"),
     *   @OA\Response(response="41108005",description="The Api Reference is disabled"),
     *   @OA\Response(response="41008001",description="The Balance API is disabled"),
     *   @OA\Response(response="41108006",description="Option %s with reference (reference) not found"),
     *   @Security(name="Basic")
     * )
     */
    public function cancel(int $transactionId): JsonResponse
    {
        $transaction = $this->cancelService->cancel($transactionId);

        $response = $this->statusService->generateResponse($transaction);

        $response->code = AppConstants::SUCCESS_CODE;
        $response->message = AppConstants::SUCCESS_MESSAGE;

        return $this->json($response);
    }
}
