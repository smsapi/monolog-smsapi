<?php
namespace MonologSmsapi;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use Monolog\Logger;
use SMSApi\Client;
use function Assert\that;
use function Assert\thatNullOr;

class SmsapiConfig
{
    const FORMATTER_OUTPUT_LENGTH = 'formatter_output_length';
    const FORMATTER_DATE_FORMAT = 'formatter_date_format';
    const HANDLER_LOGGER_LEVEL = 'handler_logger_level';
    const HANDLER_BUBBLE = 'handler_bubble';
    const SENDER_FROM = 'sender_from';
    const SENDER_TO = 'sender_to';
    const SENDER_CLIENT = 'sender_client';

    public $formatterOutputLength = 160;
    public $formatterDateFormat;
    public $handlerLoggerLevel = Logger::CRITICAL;
    public $handlerBubble = true;
    public $senderFrom;
    public $senderTo;
    public $senderClient;

    public function __construct(array $data)
    {
        $this
            ->setSenderFrom($data[static::SENDER_FROM])
            ->setSenderTo($data[static::SENDER_TO])
            ->setSenderClient($data[static::SENDER_CLIENT]);

        if (isset($data[static::FORMATTER_OUTPUT_LENGTH])) {
            $this->setFormatterOutputLength($data[static::FORMATTER_OUTPUT_LENGTH]);
        }

        if (isset($data[static::FORMATTER_DATE_FORMAT])) {
            $this->setFormatterDateFormat($data[static::FORMATTER_DATE_FORMAT]);
        }

        if (isset($data[static::HANDLER_LOGGER_LEVEL])) {
            $this->setHandlerLoggerLevel($data[static::HANDLER_LOGGER_LEVEL]);
        }

        if (isset($data[static::HANDLER_BUBBLE])) {
            $this->setHandlerBubble($data[static::HANDLER_BUBBLE]);
        }
    }

    private function setFormatterOutputLength($formatterOutputLength)
    {
        that($formatterOutputLength)
            ->integerish()
            ->range(0, 918);

        $this->formatterOutputLength = $formatterOutputLength;

        return $this;
    }

    private function setFormatterDateFormat($formatterDateFormat)
    {
        $tester = new \DateTime;
        if ($tester->format($formatterDateFormat) === false) {
            throw new InvalidArgumentException('Invalid date format', 0, null, $formatterDateFormat);
        }

        $this->formatterDateFormat = $formatterDateFormat;

        return $this;
    }

    private function setHandlerLoggerLevel($handlerLoggerLevel)
    {
        $levels = [
            Logger::DEBUG,
            Logger::INFO,
            Logger::NOTICE,
            Logger::WARNING,
            Logger::ERROR,
            Logger::CRITICAL,
            Logger::ALERT,
            Logger::EMERGENCY,
        ];

        Assertion::inArray($handlerLoggerLevel, $levels);

        $this->handlerLoggerLevel = $handlerLoggerLevel;

        return $this;
    }

    private function setHandlerBubble($handlerBubble)
    {
        Assertion::boolean($handlerBubble);

        $this->handlerBubble = $handlerBubble;

        return $this;
    }

    private function setSenderFrom($senderFrom)
    {
        that($senderFrom)
            ->scalar()
            ->minLength(1);

        $this->senderFrom = $senderFrom;

        return $this;
    }

    private function setSenderTo($senderTo)
    {
        that($senderTo)
            ->scalar()
            ->regex($senderTo, '#^[1-9][0-9]{9,15}$#');

        $this->senderTo = $senderTo;

        return $this;
    }

    private function setSenderClient(Client $senderClient)
    {
        $this->senderClient = $senderClient;

        return $this;
    }
}
