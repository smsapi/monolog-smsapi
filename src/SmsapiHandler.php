<?php
namespace MonologSmsapi;

use Monolog\Handler\AbstractProcessingHandler;

class SmsapiHandler extends AbstractProcessingHandler
{
    private $sender;
    private $formatterFactory;
    private $config;

    public function __construct(MessageSender $sender, SmsapiFormatterFactory $formatterFactory, SmsapiConfig $config)
    {
        parent::__construct($config->handlerLoggerLevel, $config->handlerBubble);

        $this->sender = $sender;
        $this->formatterFactory = $formatterFactory;
        $this->config = $config;
    }

    protected function write(array $record)
    {
        $this->sender->send($record['formatted']);
    }

    protected function getDefaultFormatter()
    {
        return $this->formatterFactory->createDefault();
    }
}
