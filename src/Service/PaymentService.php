<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Dto\ProviderPaymentResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Entity\Transaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\PaymentRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadApiResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\PaymentAPIException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ReferencePaidException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\Status;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\PaymentService as BasePaymentService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\TransactionService;

class PaymentService implements BasePaymentService
{
    private TransactionService $transactionService;
    private OptionService $optionService;
    private NotificationService $notificationService;
    private ReferenceService $referenceService;
    private PaymentSuccessService $paymentSuccessService;
    private PaymentErrorService $paymentErrorService;
    private PaymentFailedService $paymentFailedService;
    private PaymentVerifyService $paymentVerifyService;
    private PaymentProcessService $paymentProcessService;

    public function __construct(
        TransactionService $transactionService,
        OptionService $optionService,
        NotificationService $notificationService,
        ReferenceService $referenceService,
        PaymentSuccessService $paymentSuccessService,
        PaymentErrorService $paymentErrorService,
        PaymentFailedService $paymentFailedService,
        PaymentVerifyService $paymentVerifyService,
        PaymentProcessService $paymentProcessService
    ) {
        $this->transactionService = $transactionService;
        $this->optionService = $optionService;
        $this->notificationService = $notificationService;
        $this->referenceService = $referenceService;
        $this->paymentSuccessService = $paymentSuccessService;
        $this->paymentErrorService = $paymentErrorService;
        $this->paymentFailedService = $paymentFailedService;
        $this->paymentVerifyService = $paymentVerifyService;
        $this->paymentProcessService = $paymentProcessService;
    }

    /**
     * pay.
     *
     * @throws \Exception
     */
    public function pay(PaymentRequest $request): Transaction
    {
        $this->paymentVerifyService->verify($request);

        $reference = null;

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['REFERENCE_API_ENABLED']) {
            $reference = $this->referenceService->findByReferenceNumber($request->reference);

            if (Status::SUCCESS == $reference->status) {
                throw new ReferencePaidException($reference->referenceNumber, $reference->lastUpdatedDate->setTimezone(new \DateTimeZone($_ENV['TIME_ZONE_PROVIDER']))->format($_ENV['API_DATE_FORMAT']));
            }

            if (AppConstants::PARAMETER_FALSE_VALUE == $_ENV['AMOUNT_ENABLED'] && AppConstants::PARAMETER_FALSE_VALUE == $_ENV['OPTION_ENABLED']) {
                $request->amount = $reference->amount;
            }
        }

        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_ENABLED']) {
            $option = $this->optionService->findByReferenceAndSlug($request->reference, $request->option);
            $request->amount = $option->amount;
        }

        $transaction = $this->generateTransaction($request);
        $transaction->referenceData = $reference;

        try {
            $apiResponse = $this->paymentProcessService->payment($transaction);
            $providerResponse = $this->generateProviderPaymentResponse($apiResponse);
            $this->paymentProcessService->decision($providerResponse);
            $this->paymentSuccessService->success($transaction, $providerResponse);
            $this->notificationService->notification($transaction);
        } catch (PaymentAPIException $exception) {
            throw $this->paymentFailedService->failed($exception, $transaction);
        } catch (\Throwable $exception) {
            throw $this->paymentErrorService->error($exception, $transaction);
        }

        return $transaction;
    }

    private function generateTransaction(PaymentRequest $paymentRequest): Transaction
    {
        $transaction = new Transaction();

        foreach (get_object_vars($paymentRequest) as $key => $value) {
            if (property_exists($transaction, $key) && null != $value) {
                $transaction->$key = $value;
            }
        }

        return $this->transactionService->save($transaction);
    }

    /**
     * @throws BadApiResponse|PaymentAPIException|BadApiResponse
     */
    private function generateProviderPaymentResponse(?array $paymentResult): ProviderPaymentResponse
    {
        try {
            return $this->paymentProcessService->generateProviderPaymentResponse($paymentResult);
        } catch (\ErrorException $exception) {
            if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                throw new BadApiResponse($_ENV['API_PAYMENT'], $exception->getMessage());
            }

            throw new BadApiResponse($_ENV['API_PAYMENT']);
        }
    }
}
