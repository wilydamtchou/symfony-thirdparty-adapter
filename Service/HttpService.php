<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\HTTPTokenException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\HttpService as BaseHttpService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ParameterService;

class HttpService implements BaseHttpService
{
    protected ParameterService $parameterService;

    public function __construct(ParameterService $parameterService)
    {
        $this->parameterService = $parameterService;
    }

    /**
     * getToken.
     *
     * @throws \Exception
     */
    public function getToken(array $parameters): string
    {
        $expirationSeconds = $this->parameterService->get(AppConstants::TOKEN_EXPIRE_IN, false);
        $tokenInDatabase = $this->parameterService->getParameter(AppConstants::TOKEN, false);
        $tokenExpired = false;
        $savedToken = false;

        if ($expirationSeconds && $tokenInDatabase) {
            $savedToken = true;
            $date = new \DateTime(AppConstants::NOW, new \DateTimeZone($_ENV['TIME_ZONE']));
            if ($tokenInDatabase->lastUpdatedDate->add(new \DateInterval("PT{$expirationSeconds}S"))->getTimestamp() <= $date->getTimestamp()) {
                $tokenExpired = true;
            }
        }

        $token = null;

        if ($tokenExpired || !$savedToken) {
            $response = $this->sendGETWithBasicAuth($_ENV['API_TOKEN'], $parameters);
            if (!array_key_exists(AppConstants::ACCESS_TOKEN, $response) || !array_key_exists(AppConstants::EXPIRE_IN, $response)) {
                throw new HTTPTokenException($_ENV['API_TOKEN']);
            }
            $this->parameterService->setParameter(AppConstants::TOKEN, $response[AppConstants::ACCESS_TOKEN]);
            $this->parameterService->setParameter(AppConstants::TOKEN_EXPIRE_IN, $response[AppConstants::EXPIRE_IN]);
            $token = $response[AppConstants::ACCESS_TOKEN];
        } else {
            $token = $tokenInDatabase->value;
        }

        return $token;
    }

    /**
     * sendGETWithBasicAuth.
     *
     * @throws \Exception
     */
    public function sendGETWithBasicAuth(string $url, array $data): array
    {
        $token = base64_encode($_ENV['API_USERNAME_TOKEN'].':'.$_ENV['API_PASSWORD_TOKEN']);

        $headers = [
            sprintf(AppConstants::HEADER_AUTH_BASIC, $token),
        ];

        return $this->sendGET($url, $data, $headers);
    }

    /**
     * sendPOST.
     *
     * @throws \Exception
     */
    public function sendGETWithToken(string $url, array $data, array $credentials): array
    {
        $token = $this->getToken($credentials);

        $headers = [
            sprintf(AppConstants::HEADER_AUTH_BEARER, $token),
            AppConstants::HEADER_CONTENT_TYPE_JSON,
        ];

        return $this->sendGET($url, $data, $headers);
    }

    /**
     * sendPOST.
     *
     * @throws \Exception
     */
    public function sendPOSTWithToken(string $url, array $data, array $credentials): array
    {
        $token = $this->getToken($credentials);

        $headers = [
            sprintf(AppConstants::HEADER_AUTH_BEARER, $token),
            AppConstants::HEADER_CONTENT_TYPE_JSON,
        ];

        return $this->sendPOST($url, $data, $headers);
    }

    /**
     * sendPOST.
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendPOST(string $url, array $data, ?array $headers = null): array
    {
        $parameters = [
            CURLOPT_CUSTOMREQUEST => AppConstants::POST,
            CURLOPT_POSTFIELDS => json_encode($data),
        ];

        if ($headers) {
            $parameters[CURLOPT_HTTPHEADER] = $headers;
        }

        return $this->sendRequest($url, $parameters);
    }

    /**
     * sendGET.
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendGET(string $url, array $data, ?array $headers = null): array
    {
        $parameters = [
            CURLOPT_URL => $url.'?'.http_build_query($data),
        ];

        if ($headers) {
            $parameters[CURLOPT_HTTPHEADER] = $headers;
        }

        return $this->sendRequest($url, $parameters);
    }

    /**
     * sendRequest.
     *
     * @throws NetworkException|GeneralNetworkException
     */
    protected function sendRequest(string $url, array $params): array
    {
        $result = null;

        try {
            $curl = curl_init();

            $parameters = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => $_ENV['CURL_MAXREDIRS'],
                CURLOPT_TIMEOUT => $_ENV['CURL_TIMEOUT'],
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTPHEADER => [AppConstants::APP_JSON_HEADER],
            ];

            foreach ($params as $key => $value) {
                $parameters[$key] = $value;
            }

            curl_setopt_array(
                $curl,
                $parameters
            );

            $response = curl_exec($curl);
            $result = json_decode($response, true);

            curl_close($curl);

            if (!$result || !$response) {
                if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                    throw new NetworkException($url);
                } else {
                    throw new NetworkException('');
                }
            }
        } catch (\Throwable $exception) {
            if ($exception instanceof NetworkException) {
                throw $exception;
            }

            if (AppConstants::ENV_DEV == $_ENV['APP_ENV']) {
                $mes = ', file :'.$exception->getFile().', line: '.$exception->getLine().', message:'.$exception->getMessage();
                throw new GeneralNetworkException($url, $mes);
            }

            throw new GeneralNetworkException($url);
        }

        return $result;
    }
}
