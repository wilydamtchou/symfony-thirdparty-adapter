<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\Email;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\SMS;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EmailApiDisabled;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\SMSApiDisabled;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\MessagingService as BaseMessagingService;

class MessagingService implements BaseMessagingService
{
    private HttpService $httpService;

    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
    }

    /**
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function sms(SMS $sms): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['SMS_ENABLED']) {
            throw new SMSApiDisabled();
        }

        $this->httpService->sendPOST($_ENV['API_SMS'], $sms->toArray());
    }

    /**
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function email(Email $email): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE != $_ENV['EMAIL_API_ENABLED']) {
            throw new EmailApiDisabled();
        }

        $this->httpService->sendPOST($_ENV['API_EMAIL'], $email->toArray());
    }

    /**
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function smsWith(string $sender, string $phone, string $message, string $country): void
    {
        $sms = new SMS();

        $sms->sender = $sender;
        $sms->phone = $phone;
        $sms->message = $message;
        $sms->country = $country;

        $this->sms($sms);
    }

    /**
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function emailWith(string $sender, string $email, string $message, string $object): void
    {
        $mail = new Email();

        $mail->sender = $sender;
        $mail->email = $email;
        $mail->message = $message;
        $mail->object = $object;

        $this->email($mail);
    }

    /**
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function sendSMS(string $phone, string $message): void
    {
        $this->smsWith($_ENV['SMS_SENDER'], $phone, $message, $_ENV['SMS_COUNTRY']);
    }

    /**
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function sendEmail(string $email, string $message, string $object): void
    {
        $this->emailWith($_ENV['EMAIL_SENDER'], $email, $message, $object);
    }

    /**
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function sendSMSList(string $phones, string $message): void
    {
        foreach (explode($_ENV['SMS_SEPARATOR'], $phones) as $value) {
            $this->sendSMS($value, $message);
        }
    }

    /**
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function sendEmailList(string $emails, string $message, string $object): void
    {
        foreach (explode($_ENV['EMAIL_SEPARATOR'], $emails) as $value) {
            $this->sendEmail($value, $message, $object);
        }
    }
}
