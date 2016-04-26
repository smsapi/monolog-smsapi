<?php
namespace MonologSmsapi;

use SMSApi\Api\SmsFactory;

class SmsapiSender implements MessageSender
{
    private $smsFactory;
    private $sender;
    private $receiver;

    public function __construct(SmsFactory $smsFactory, $sender, $receiver)
    {
        $this->smsFactory = $smsFactory;
        $this->sender = $sender;
        $this->receiver = $receiver;
    }

    public function send($message)
    {
        $actionSend = $this->smsFactory->actionSend();

        $actionSend
            ->setText($message)
            ->setSender($this->sender)
            ->setTo($this->receiver)
            ->execute();
    }
}
