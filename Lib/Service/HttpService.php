<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;

interface HttpService
{
    /**
     * getToken.
     *
     * @throws \Exception
     */
    public function getToken(array $parameters): string;

    /**
     * sendGETWithBasicAuth.
     *
     * @throws \Exception
     */
    public function sendGETWithBasicAuth(string $url, array $data): array;

    /**
     * sendGETWithToken.
     *
     * @throws \Exception
     */
    public function sendGETWithToken(string $url, array $data, array $credentials): array;

    /**
     * sendPOSTWithToken.
     *
     * @throws \Exception
     */
    public function sendPOSTWithToken(string $url, array $data, array $credentials): array;

    /**
     * sendPOST.
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendPOST(string $url, array $data): array;

    /**
     * sendGET.
     *
     * @throws NetworkException|GeneralNetworkException
     */
    public function sendGET(string $url, array $data): array;
}
