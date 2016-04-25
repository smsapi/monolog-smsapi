<?php
namespace MonologSmsapi;

class SmsapiFormatterFactory
{
    private $smsapiConfig;

    public function __construct(SmsapiConfig $smsapiConfig)
    {
        $this->smsapiConfig = $smsapiConfig;
    }

    public function createDefault()
    {
        return new SmsapiFormatter($this->smsapiConfig);
    }
}
