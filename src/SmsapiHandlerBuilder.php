<?php
namespace MonologSmsapi;

use SMSApi\Api\SmsFactory;
use SMSApi\Proxy\Proxy;

class SmsapiHandlerBuilder
{
    private $smsapiProxy;

    public function smsapiProxy(Proxy $smsapiProxy = null)
    {
        $this->smsapiProxy = $smsapiProxy;
    }

    public function buildFromConfig(SmsapiConfig $smsapiConfig)
    {
        $smsFactory = new SmsFactory($this->smsapiProxy, $smsapiConfig->senderClient);
        $smsapiSender = new SmsapiSender($smsFactory, $smsapiConfig->senderFrom, $smsapiConfig->senderTo);
        $formatterFactory = new SmsapiFormatterFactory($smsapiConfig);

        return new SmsapiHandler($smsapiSender, $formatterFactory, $smsapiConfig);
    }
}
