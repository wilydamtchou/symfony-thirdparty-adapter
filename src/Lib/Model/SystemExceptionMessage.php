<?php

namespace Willydamtchou\SymfonyThirdpartyAdapter\Lib\Model;

/**
 * Class SystemExceptionMessage.
 */
final class SystemExceptionMessage
{
    public const GENERAL_FAILURE = [AppConstants::CODE => '500', AppConstants::MESSAGE => 'General Failure %s'];

    public const NETWORK_FAILURE = [AppConstants::CODE => '501', AppConstants::MESSAGE => 'Network Failure on API %s'];

    public const HTTP_TOKEN_FAILURE = [AppConstants::CODE => '503', AppConstants::MESSAGE => 'Error occured when getting token on API %s'];

    public const BAD_API_RESPONSE = [AppConstants::CODE => '504', AppConstants::MESSAGE => 'Bad API Response format on API %s'];

    public const DATABASE_CONNECTIVITY_FAILURE = [AppConstants::CODE => '505', AppConstants::MESSAGE => 'Database Connectivity failure'];

    public const GENERAL_NETWORK_FAILURE = [AppConstants::CODE => '506', AppConstants::MESSAGE => 'General Network Failure on API %s'];

    public const CONFIG_NOT_AUTHORIZED = [AppConstants::CODE => '507', AppConstants::MESSAGE => 'Configuration view is disabled. Contact support'];

    public const URI_NOT_FOUND = [AppConstants::CODE => '404', AppConstants::MESSAGE => 'URI Not found'];

    public const REGULATE_FAILURE = [AppConstants::CODE => '505%s003', AppConstants::MESSAGE => 'An error occured after the payment %s. Transaction must be regulated '];

    public const SMS_API_DISABLED = [AppConstants::CODE => '505%s004', AppConstants::MESSAGE => 'SMS API is disabled'];

    public const EMAIL_API_DISABLED = [AppConstants::CODE => '505%s005', AppConstants::MESSAGE => 'Email API is disabled'];

    public const ENTITY_NOT_FOUND = [AppConstants::CODE => '405', AppConstants::MESSAGE => '%s with %s %s not found'];

    public const ENTITY_ALREADY_EXIST = [AppConstants::CODE => '406', AppConstants::MESSAGE => '%s with %s %s already exist'];

    public const LIST_ENTITY_NOT_FOUND = [AppConstants::CODE => '407', AppConstants::MESSAGE => 'No %s found'];

    public const PARAMETER_NOT_FOUND = [AppConstants::CODE => '408', AppConstants::MESSAGE => 'Parameter %s not found, verify configuration'];

    public const PARAMETER_ENV_NOT_FOUND = [AppConstants::CODE => '409', AppConstants::MESSAGE => 'Environment parameter %s must be specified, verify configuration'];

    public const VERIFY_GENERAL_FAILURE = [AppConstants::CODE => '501%s000', AppConstants::MESSAGE => 'General failure %s'];

    public const VERIFY_DATABASE_FAILURE = [AppConstants::CODE => '501%s001', AppConstants::MESSAGE => 'Database connectivity error'];

    public const VERIFY_BAD_REFERENCE_FORMAT = [AppConstants::CODE => '401%s001', AppConstants::MESSAGE => 'Bad reference %s format %s'];

    public const VERIFY_INVALID_AMOUNT_RANGE = [AppConstants::CODE => '401%s002', AppConstants::MESSAGE => 'Invalid amount %s range [%s - %s]'];

    public const VERIFY_BAD_PHONE_FORMAT = [AppConstants::CODE => '401%s003', AppConstants::MESSAGE => 'Bad Phone %s format %s'];

    public const VERIFY_BAD_EMAIL_FORMAT = [AppConstants::CODE => '401%s004', AppConstants::MESSAGE => 'Bad Email %s format'];

    public const VERIFY_INVALID_OPTION_VALUE = [AppConstants::CODE => '401%s005', AppConstants::MESSAGE => 'Invalid Option %s value'];

    public const VERIFY_INVALID_OPTION_AMOUNT_VALUE = [AppConstants::CODE => '401%s006', AppConstants::MESSAGE => 'Invalid Option %s Amount %s value'];

    public const REFERENCE_NOT_FOUND = [AppConstants::CODE => '402%s002', AppConstants::MESSAGE => 'Reference %s not found'];

    public const REFERENCE_ALREADY_PAID = [AppConstants::CODE => '402%s003', AppConstants::MESSAGE => 'Reference %s has already been paid on %s'];

    public const VERIFY_APPLICATION_ERROR = [AppConstants::CODE => '303%s%s', AppConstants::MESSAGE => 'Verify Application error : %s'];

    public const VERIFY_API_ERROR = [AppConstants::CODE => '101%s%s', AppConstants::MESSAGE => 'API error : %s'];

    public const PAYMENT_APPLICATION_ERROR = [AppConstants::CODE => '305%s%s', AppConstants::MESSAGE => 'Payment Application error : %s'];

    public const BALANCE_APPLICATION_ERROR = [AppConstants::CODE => '310%s%s', AppConstants::MESSAGE => 'Balance Application error %s'];

    public const PAYMENT_REQUIRED_FINANCIAL_ID = [AppConstants::CODE => '405%s006', AppConstants::MESSAGE => 'Financial Id is required'];

    public const PAYMENT_DUPLICATE_EXTERNAL_ID = [AppConstants::CODE => '405%s007', AppConstants::MESSAGE => 'Duplicate ExternalId %s'];

    public const PAYMENT_DUPLICATE_REQUEST_ID = [AppConstants::CODE => '405%s008', AppConstants::MESSAGE => 'Duplicate RequestId %s'];

    public const PAYMENT_DUPLICATE_APPLICATION_ID = [AppConstants::CODE => '405%s009', AppConstants::MESSAGE => 'Duplicate ApplicationId %s'];

    public const PAYMENT_DUPLICATE_FINANCIAL_ID = [AppConstants::CODE => '405%s010', AppConstants::MESSAGE => 'Duplicate FinancialId %s'];

    public const PAYMENT_DUPLICATE_PROVIDER_ID = [AppConstants::CODE => '405%s011', AppConstants::MESSAGE => 'Duplicate ProviderId %s'];

    public const PAYMENT_DUPLICATE_TRANSACTION_ID = [AppConstants::CODE => '405%s012', AppConstants::MESSAGE => 'Duplicate TransactionId %s'];

    public const PAYMENT_REQUIRED_EXTERNAL_ID = [AppConstants::CODE => '405%s013', AppConstants::MESSAGE => 'ExternalId is required'];

    public const PAYMENT_REQUIRED_REQUEST_ID = [AppConstants::CODE => '405%s014', AppConstants::MESSAGE => 'RequestId is required'];

    public const PAYMENT_REQUIRED_APPLICATION_ID = [AppConstants::CODE => '405%s015', AppConstants::MESSAGE => 'ApplicationId is required'];

    public const PAYMENT_REQUIRED_ACCOUNT_NUMBER = [AppConstants::CODE => '405%s016', AppConstants::MESSAGE => 'Account Number is required'];

    public const PAYMENT_REQUIRED_ACCOUNT_NAME = [AppConstants::CODE => '405%s017', AppConstants::MESSAGE => 'Account Name is required'];

    public const ILLEGAL_STATUS_CONFIRM_EXCEPTION = [AppConstants::CODE => '408%s004', AppConstants::MESSAGE => 'Transaction with transactionId %s could not be confirmed in status %s'];

    public const ILLEGAL_STATUS_CANCEL_EXCEPTION = [AppConstants::CODE => '408%s005', AppConstants::MESSAGE => 'Transaction with transactionId %s could not be canceled in status %s'];

    public const PAYMENT_API_EXCEPTION = [AppConstants::CODE => '105%s%s', AppConstants::MESSAGE => 'Payment API Exception : %s'];

    public const REQUIRED_OPTION_NAME = [AppConstants::CODE => '411%s001', AppConstants::MESSAGE => 'Option Name is required'];

    public const REQUIRED_OPTION_AMOUNT = [AppConstants::CODE => '411%s002', AppConstants::MESSAGE => 'Option Amount is required'];

    public const OPTION_ALREADY_EXIST = [AppConstants::CODE => '411%s003', AppConstants::MESSAGE => 'The Option slug %s already exist'];

    public const OPTION_API_DISABLED = [AppConstants::CODE => '411%s004', AppConstants::MESSAGE => 'The Api Option is disabled'];

    public const REFERENCE_API_DISABLED = [AppConstants::CODE => '411%s005', AppConstants::MESSAGE => 'The Api Reference is disabled'];

    public const BALANCE_API_DISABLED = [AppConstants::CODE => '410%s001', AppConstants::MESSAGE => 'The Balance API is disabled'];

    public const OPTION_REFERENCE_SLUG_NOT_FOUND = [AppConstants::CODE => '411%s006', AppConstants::MESSAGE => 'Option %s with reference %s not found'];

}
