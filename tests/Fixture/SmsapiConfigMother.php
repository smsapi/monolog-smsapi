<?php
namespace MonologSmsapi\Tests\Fixture;

use MonologSmsapi\SmsapiConfig;
use SMSApi\Client;

class SmsapiConfigMother
{
    public static function createWithGivenFormatterOutputLength($formatterOutputLength)
    {
        return static::createDefault([SmsapiConfig::FORMATTER_OUTPUT_LENGTH => $formatterOutputLength]);
    }

    public static function createWithGivenHandlerBubble($handlerBubble)
    {
        return static::createDefault([SmsapiConfig::HANDLER_BUBBLE => $handlerBubble]);
    }

    public static function createWithGivenHandlerLoggerLevel($handlerLoggerLevel)
    {
        return static::createDefault([SmsapiConfig::HANDLER_LOGGER_LEVEL => $handlerLoggerLevel]);
    }

    public static function createWithGivenFormatterDateFormat($formatterDateFormat)
    {
        return static::createDefault([SmsapiConfig::FORMATTER_DATE_FORMAT => $formatterDateFormat]);
    }

    public static function createDefault(array $data = [])
    {
        $someSenderTo = 48790000000;
        $default = [
            SmsapiConfig::SENDER_CLIENT => new Client('some_username'),
            SmsapiConfig::SENDER_FROM => 'some_from',
            SmsapiConfig::SENDER_TO => $someSenderTo,
        ];

        return new SmsapiConfig(array_merge($default, $data));
    }
}
