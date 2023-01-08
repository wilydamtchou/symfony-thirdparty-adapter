<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\VerifyRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadEmailException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadPhoneException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadReferenceException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\InvalidAmountException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\InvalidAmountOptionException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\InvalidOptionException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ReferenceApiDisabledException;

interface VerifyService
{
    /**
     * @throws BadReferenceException
     */
    public function verifyReference(?string $reference = null): void;

    /**
     * @throws InvalidAmountException
     */
    public function verifyAmount(?float $amount = null): void;

    /**
     * @throws InvalidOptionException|InvalidAmountOptionException
     */
    public function verifyOption(?string $option = null, ?float $amount = null): void;

    /**
     * @throws BadPhoneException
     */
    public function verifyPhone(?string $phone = null): void;

    /**
     * @throws BadEmailException
     */
    public function verifyEmail(?string $email = null): void;

    /**
     * @throws ReferenceApiDisabledException
     */
    public function verifyReferenceAPI(): void;

    /**
     * @throws BadReferenceException|InvalidAmountException|InvalidOptionException|InvalidAmountOptionException|BadPhoneException|BadEmailException
     */
    public function verify(VerifyRequest $request): void;
}
