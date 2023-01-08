<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\Email;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Dto\SMS;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\EmailApiDisabled;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\GeneralNetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\NetworkException;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Exception\SMSApiDisabled;

interface MessagingService
{
    /**
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function sms(SMS $sms): void;

    /**
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function email(Email $email): void;

    /**
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function smsWith(string $sender, string $phone, string $message, string $country): void;

    /**
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function emailWith(string $sender, string $email, string $message, string $object): void;

    /**
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function sendSMS(string $phone, string $message): void;

    /**
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function sendEmail(string $email, string $message, string $object): void;

    /**
     * @throws NetworkException|GeneralNetworkException|SMSApiDisabled
     */
    public function sendSMSList(string $phones, string $message): void;

    /**
     * @throws NetworkException|GeneralNetworkException|EmailApiDisabled
     */
    public function sendEmailList(string $emails, string $message, string $object): void;
}
