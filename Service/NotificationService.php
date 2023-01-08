<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction as BaseTransaction;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model\AppConstants;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\MessagingService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\NotificationService as BaseNotificationService;
use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service\ReferenceService;

class NotificationService implements BaseNotificationService
{
    protected MessagingService $messagingService;
    protected ReferenceService $referenceService;

    public function __construct(MessagingService $messagingService, ReferenceService $referenceService)
    {
        $this->messagingService = $messagingService;
        $this->referenceService = $referenceService;
    }

    public function notification(BaseTransaction $transaction): void
    {
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['PHONE_ENABLED']) {
            $this->messagingService->sendSMS($transaction->phone, $this->generateClientSMS($transaction));
        }
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['EMAIL_ENABLED']) {
            $this->messagingService->sendEmail($transaction->email, $this->generateClientEmail($transaction), $_ENV['EMAIL_CLIENT_OBJECT']);
        }
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['NOTIF_ADMIN_PHONES']) {
            $this->messagingService->sendSMSList($_ENV['ADMIN_PHONES'], $this->generateAdminSMS($transaction));
        }
        if (AppConstants::PARAMETER_TRUE_VALUE == $_ENV['NOTIF_ADMIN_EMAILS']) {
            $this->messagingService->sendEmailList($_ENV['ADMIN_EMAILS'], $this->generateAdminEmail($transaction), $_ENV['EMAIL_ADMIN_OBJECT']);
        }
    }

    public function generateClientSMS(BaseTransaction $transaction): string
    {
        $reference = $this->referenceService->findByReferenceNumber($transaction->reference);

        return sprintf($_ENV['NOTIF_SMS_MESSAGE'], $reference->referenceNumber, $reference->lastUpdatedDate->setTimezone(new \DateTimeZone($_ENV['TIME_ZONE_PROVIDER']))->format($_ENV['API_DATE_FORMAT']), $reference->name, $reference->amount);
    }

    public function generateAdminSMS(BaseTransaction $transaction): string
    {
        $reference = $this->referenceService->findByReferenceNumber($transaction->reference);

        return sprintf($_ENV['NOTIF_SMS_ADMIN_MESSAGE'], $reference->referenceNumber, $reference->lastUpdatedDate->setTimezone(new \DateTimeZone($_ENV['TIME_ZONE_PROVIDER']))->format($_ENV['API_DATE_FORMAT']), $reference->name, $reference->amount);
    }

    public function generateClientEmail(BaseTransaction $transaction): string
    {
        return $transaction->toEmailString(AppConstants::TRANSACTIONS_DETAILS);
    }

    public function generateAdminEmail(BaseTransaction $transaction): string
    {
        return $transaction->toEmailString(AppConstants::TRANSACTIONS_DETAILS);
    }
}
