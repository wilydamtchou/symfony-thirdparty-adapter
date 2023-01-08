<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Model;

class AppConstants
{
    public const API_CODE = 'code';
    public const API_MESSAGE = 'message';
    public const API_DATA = 'data';
    public const API_DATA_TRANSACTION_ID = 'transactionId';
    public const API_DATA_MESSAGE = 'message';
    public const API_DATA_STATUS = 'status';
    public const API_SUCCESS_CODE = 200;

    public const CONVERSION_RESULT_REFERENCE = [
        'referenceNumber' => 'billNumber',
        'generationDate' => 'billGenerationDate',
        'expirationDate' => 'billDueDate',
        'amount' => 'billAmount',
        'name' => 'customerName',
    ];

    public const STATUS_TABLE = [
        'ESTADO' => 'DESC_EST',
        'ER010' => 'BILLED',
        'ER015' => 'RECEIVABLE',
        'ER018' => 'REFERRED INVOICE',
        'ER020' => 'SENT TO CUSTOMER',
        'ER120' => 'DEBT CERTIFIED',
        'ER125' => 'PAYMENT RECEIVED',
        'ER130' => 'GENERATED SUSPENSION ORDER',
        'ER160' => 'SUSPENSION PROCESS DETAINED',
        'ER200' => 'SUSPENDED',
        'ER203' => 'GENERATED SUSPENSION REVIEW ORDER',
        'ER205' => 'SUSPENSION REVIEW',
        'ER210' => 'CREDIT APPLICATION ON INVOICES',
        'ER220' => 'DEPOSIT PLUS INTEREST APPLICATION ON INVOICES',
        'ER225' => 'NOT  IN USE - FORMALLY DEBT NOTICE SENT',
        'ER230' => 'FINAL DEMAND LETTER',
        'ER235' => 'DE-ENROLLED CONTRACT',
        'ER236' => 'MANUAL DE-ENROLLED CONTRACT',
        'ER240' => 'POTENTIAL WRITE-OFF',
        'ER241' => 'MANUAL POTENTIAL WRITE-OFF',
        'ER245' => 'UNDER LEGAL ACTIONS',
        'ER250' => 'DEFINITE WRITE-OFF',
        'ER251' => 'MANUAL DEFINITE WRITE-OFF',
        'ER270' => 'CANCELLATION PROCEDURE',
        'ER290' => 'DEFINITE UNCOLLECTABLE PENDING APPROVAL',
        'ER300' => 'COMPENSATED',
        'ER310' => 'PAID',
        'ER311' => 'AUTOMATICALLY COLLECTED ZERO AMOUNT',
        'ER312' => 'COLLECTED FOR REDUCED AMOUNT BILL',
        'ER314' => 'AUTOMATICALLY COLLECTED USD BILL',
        'ER315' => 'AUTOMATICALLY COLLECTED STAFF INVOICE',
        'ER320' => 'PAID UNDER INSTALMENT AGREEMENT',
        'ER330' => 'PAID UNDER BUDGET PLAN',
        'ER350' => 'COLLECTED BY SPLIT RECEIVABLES',
        'ER360' => 'SETTLED TO PAY AS TIP_FORMA_PAGO FP006',
        'ER400' => 'UNDER COMPLAINT',
        'ER410' => 'PAID, UNDER COMPLAINT',
        'ER500' => 'UNDER INSTALMENT AGREEMENT',
        'ER560' => 'UNDER BUDGET PLAN',
        'ER600' => 'CANCELLED',
        'ER620' => 'PAID AND NOT NOTIFIED',
        'ER630' => 'CANCELLED DUE TO TRANSFER TO ANOTHER ACCOUNT',
        'ER900' => 'CANCELLED DUE TO CREATION OF MORE THAN ONE RECEIVABLE',
        'ER915' => 'ERRONEOUS DATA',
    ];
}
