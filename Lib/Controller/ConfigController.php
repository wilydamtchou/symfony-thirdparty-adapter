<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\BasicListResponse;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ConfigException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\SystemExceptionMessage;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\UtilService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ConfigController.
 */
class ConfigController extends AbstractController
{
    private UtilService $utilService;

    public function __construct(UtilService $utilService)
    {
        $this->utilService = $utilService;
    }

    /**
     * Parameters API.
     *
     * @Route("/parameters")
     */
    public function parameters(): JsonResponse
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['SHOW_CONFIG']) {
            throw new ConfigException();
        }

        $config = [];

        foreach ($_ENV as $key => $value) {
            $camelKey = $this->utilService->dashesToCamelCase($key, AppConstants::SEPARATOR_PARAMETER);
            if (!in_array($camelKey, AppConstants::EXCLUDE_API_CONFIG_PARAMETERS)) {
                $config[$camelKey] = $value;
            }
        }

        $response = new BasicListResponse();

        $response->code = AppConstants::SUCCESS_CODE;
        $response->message = AppConstants::SUCCESS_MESSAGE;
        $response->result = $config;

        return $this->json($response);
    }

    /**
     * Exceptions API.
     *
     * @Route("/exceptions")
     */
    public function exceptions(): JsonResponse
    {
        $data = (new \ReflectionClass(SystemExceptionMessage::class))->getConstants();

        $exceptions = [];

        foreach ($data as $key => $value) {
            $camelKey = $this->utilService->dashesToCamelCase($key, AppConstants::SEPARATOR_PARAMETER);
            $code = sprintf($value[AppConstants::CODE], $_ENV['APP_CODE'], '');
            $exceptions[$camelKey] = [AppConstants::CODE => (int) $code, AppConstants::MESSAGE => $value[AppConstants::MESSAGE]];
        }

        $response = new BasicListResponse();

        $response->code = AppConstants::SUCCESS_CODE;
        $response->message = AppConstants::SUCCESS_MESSAGE;
        $response->result = $exceptions;

        return $this->json($response);
    }
}
