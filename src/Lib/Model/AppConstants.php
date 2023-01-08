<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * Class AppConstants.
 */
class AppConstants
{
    public const CONVERTER_REQUEST = 'request';

    public const CONVERTER_FORMAT = 'json';

    public const CODE = 'code';

    public const MESSAGE = 'message';

    public const SUCCESS_CODE = 200;

    public const SUCCESS_MESSAGE = 'success';

    public const SERVICE_UP = 'service UP';

    public const PARAMETER_TRUE_VALUE = 'true';

    public const PARAMETER_FALSE_VALUE = 'false';

    public const OPTION = 'Option';

    public const OPTIONS = 'options';

    public const TRANSACTION = 'Transaction';

    public const PARAMETER = 'Parameter';

    public const ID = 'id';

    public const REFERENCE_ID = 'referenceId';

    public const REFERENCE_NUMBER = 'referenceNumber';

    public const OPTION_ID = 'optionId';

    public const TRANSACTION_ID = 'transactionId';

    public const PARAMETER_ID = 'parameterId';

    public const FINANCIAL_ID = 'financialId';

    public const REQUEST_ID = 'requestId';

    public const APPLICATION_ID = 'applicationId';

    public const EXTERNAL_ID = 'externalId';

    public const PROVIDER_ID = 'providerId';

    public const KEY = 'key';

    public const SLUG = 'slug';

    public const ENV_DEV = 'dev';

    public const APP_JSON_HEADER = 'Content-Type: application/json';

    public const POST = 'POST';

    public const TRY_AGAIN = 'try again later';

    public const BALANCE = 'balance';

    public const TOKEN = 'token';

    public const BALANCE_NAME = 'Balance';

    public const REFERENCE = 'reference';

    public const NAME = 'name';

    public const AMOUNT = 'amount';

    public const VALUES = 'values';

    public const TRANSACTIONS_DETAILS = 'Transactions details';

    public const SEPARATOR_PARAMETER = '_';

    public const HEADER_AUTH_BEARER = 'Authorization: Bearer %s';
    public const HEADER_CONTENT_TYPE_JSON = 'Content-Type: application/json';

    public const HEADER_AUTH_BASIC= 'Authorization: Basic %s';

    public const ACCESS_TOKEN = 'access_token';

    public const TOKEN_EXPIRE_IN = 'tokenExpireIn';

    public const EXPIRE_IN = 'expires_in';

    public const EXCLUDE_API_CONFIG_PARAMETERS = [
        'appSecret',
        'httpBasicAuthUsername',
        'httpBasicAuthPassword',
        'databaseUrl',
        'apiPayment',
        'apiOption',
        'apiReference',
        'adminPhones',
        'adminEmails',
        'smsSeparator',
        'apiSms',
        'smsAdminTemplate',
        'emailAdminObject',
        'emailSeparator',
        'apiEmail',
        'setBalanceAfterPayment',
        'symfonyDotenvVars',
        'appDebug',
        'shellVerbosity',
    ];

    public const PARAMETERS = 'parameters';

    public const NOW = 'now';
}

