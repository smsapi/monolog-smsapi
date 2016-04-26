<?php
namespace MonologSmsapi;

interface MessageSender
{
    /**
     * @param string $message
     */
    public function send($message);
}
