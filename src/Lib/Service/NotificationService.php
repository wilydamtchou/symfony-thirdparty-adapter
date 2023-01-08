<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Service;

use Willydamtchou\SymfonyThirdpartyAdapter\Lib\Entity\Transaction;

interface NotificationService
{
    public function notification(Transaction $transaction): void;

    public function generateClientSMS(Transaction $transaction): string;

    public function generateAdminSMS(Transaction $transaction): string;

    public function generateClientEmail(Transaction $transaction): string;

    public function generateAdminEmail(Transaction $transaction): string;
}
