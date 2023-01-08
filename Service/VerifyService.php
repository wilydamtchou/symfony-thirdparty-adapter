<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dao\OptionManager;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\VerifyRequest;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadEmailException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadPhoneException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\BadReferenceException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\InvalidAmountException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\InvalidAmountOptionException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\InvalidOptionException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\ReferenceApiDisabledException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\VerifyService as BaseVerifyService;

class VerifyService implements BaseVerifyService
{
    protected OptionManager $optionManager;

    public function __construct(OptionManager $optionManager)
    {
        $this->optionManager = $optionManager;
    }

    /**
     * @throws BadReferenceException
     */
    public function verifyReference(?string $reference = null): void
    {
        if (!preg_match($_ENV['REFERENCE_REGEX'], $reference)) {
            throw new BadReferenceException($reference);
        }
    }

    /**
     * @throws InvalidAmountException
     */
    public function verifyAmount(?float $amount = null): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['AMOUNT_ENABLED'] && ($amount > $_ENV['AMOUNT_MAX'] || $amount < $_ENV['AMOUNT_MIN'])) {
            throw new InvalidAmountException($amount);
        }
    }

    /**
     * @throws InvalidOptionException|InvalidAmountOptionException
     */
    public function verifyOption(?string $option = null, ?float $amount = null): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['OPTION_ENABLED']) {
            if (!$option) {
                throw new InvalidOptionException($option);
            }
            $optionO = $this->optionManager->findOneBySlug($option, false);
            if (!$optionO) {
                throw new InvalidOptionException($option);
            }
            if ($amount && $amount != $optionO->amount) {
                throw new InvalidAmountOptionException($option, $amount);
            }
        }
    }

    /**
     * @throws BadPhoneException
     */
    public function verifyPhone(?string $phone = null): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['PHONE_ENABLED'] && !preg_match($_ENV['PHONE_REGEX'], $phone)) {
            throw new BadPhoneException($phone);
        }
    }

    /**
     * @throws BadEmailException
     */
    public function verifyEmail(?string $email = null): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['EMAIL_ENABLED'] && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new BadEmailException($email);
        }
    }

    /**
     * @throws BadReferenceException|InvalidAmountException|InvalidOptionException|InvalidAmountOptionException|BadPhoneException|BadEmailException
     */
    public function verify(VerifyRequest $request): void
    {
        $this->verifyReference($request->reference);
        $this->verifyAmount($request->amount);
        $this->verifyOption($request->option, $request->amount);
        $this->verifyPhone($request->phone);
        $this->verifyEmail($request->email);
    }

    /**
     * @throws ReferenceApiDisabledException
     */
    public function verifyReferenceAPI(): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['REFERENCE_API_ENABLED']) {
            throw new ReferenceApiDisabledException();
        }
    }
}
