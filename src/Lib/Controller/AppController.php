<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use Doctrine\DBAL\Exception\ConnectionException;
use FOS\RestBundle\Controller\Annotations\Route;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\BasicResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\GeneralException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

/**
 * Class AppController.
 */
class AppController extends AbstractController
{
    /**
     * Default API.
     *
     * @Route("/")
     */
    public function default(): JsonResponse
    {
        $response = new BasicResponse();

        $response->code = AppConstants::SUCCESS_CODE;
        $response->message = AppConstants::SUCCESS_MESSAGE;
        $response->result = AppConstants::SERVICE_UP;

        return $this->json($response);
    }

    /**
     * @Route("/error")
     */
    public function error(\Throwable $exception, DebugLoggerInterface $logger = null): JsonResponse
    {
        $response = new BasicResponse();
        $response->result = null;

        if ($exception instanceof GeneralException) {
            $response->code = $exception->getCode();
            $response->message = $exception->getMessage();
        } elseif ($exception instanceof ConnectionException) {
            $response->code = SystemExceptionMessage::DATABASE_CONNECTIVITY_FAILURE[AppConstants::CODE];
            $response->message = sprintf(SystemExceptionMessage::DATABASE_CONNECTIVITY_FAILURE[AppConstants::MESSAGE], ': '.AppConstants::TRY_AGAIN);
        } elseif ($exception instanceof NotFoundHttpException) {
            $response->code = SystemExceptionMessage::URI_NOT_FOUND[AppConstants::CODE];
            $response->message = $exception->getMessage();
        } else {
            if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                throw $exception;
            }
            $response->code = SystemExceptionMessage::GENERAL_FAILURE[AppConstants::CODE];
            $response->message = sprintf(SystemExceptionMessage::GENERAL_FAILURE[AppConstants::MESSAGE], ': '.AppConstants::TRY_AGAIN);
        }

        return $this->json($response);
    }
}
