<?php
namespace MonologSmsapi\Tests\Double;

use MonologSmsapi\MessageSender;

class MessageSenderSpy implements MessageSender
{
    public $isSent;

    public function send($message)
    {
        $this->isSent = true;
    }
}
