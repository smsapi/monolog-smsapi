<?php
namespace MonologSmsapi;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use function Assert\thatNullOr;
use Monolog\Logger;
use SMSApi\Client;
use function Assert\that;

class SmsapiConfig
{
    const FORMATTER_OUTPUT_LENGTH = 'formatter_output_length';
    const FORMATTER_FORMAT = 'formatter_format';
    const FORMATTER_DATE_FORMAT = 'formatter_date_format';
    const FORMATTER_ALLOW_INLINE_LINE_BREAKS = 'formatter_allow_inline_line_breaks';
    const FORMATTER_IGNORE_EMPTY_CONTEXT_AND_EXTRA = 'formatter_ignore_empty_context_and_extra';
    const HANDLER_LOGGER_LEVEL = 'handler_logger_level';
    const HANDLER_BUBBLE = 'handler_bubble';
    const SENDER_FROM = 'sender_from';
    const SENDER_TO = 'sender_to';
    const SENDER_CLIENT = 'sender_client';

    public $formatterOutputLength;
    public $formatterFormat;
    public $formatterDateFormat;
    public $formatterAllowInlineLineBreaks;
    public $formatterIgnoreEmptyContextAndExtra;
    public $handlerLoggerLevel;
    public $handlerBubble;
    public $senderFrom;
    public $senderTo;
    public $senderClient;

    public function __construct(array $data)
    {
        $default = [
            static::FORMATTER_OUTPUT_LENGTH => 160,
            static::FORMATTER_FORMAT => null,
            static::FORMATTER_DATE_FORMAT => null,
            static::FORMATTER_ALLOW_INLINE_LINE_BREAKS => false,
            static::FORMATTER_IGNORE_EMPTY_CONTEXT_AND_EXTRA => false,
            static::HANDLER_LOGGER_LEVEL => Logger::CRITICAL,
            static::HANDLER_BUBBLE => true,
        ];

        $data = array_merge($default, $data);

        $this
            ->setSenderFrom($data[static::SENDER_FROM])
            ->setSenderTo($data[static::SENDER_TO])
            ->setSenderClient($data[static::SENDER_CLIENT])
            ->setFormatterOutputLength($data[static::FORMATTER_OUTPUT_LENGTH])
            ->setFormatterFormat($data[static::FORMATTER_FORMAT])
            ->setFormatterDateFormat($data[static::FORMATTER_DATE_FORMAT])
            ->setFormatterAllowInlineLineBreaks($data[static::FORMATTER_ALLOW_INLINE_LINE_BREAKS])
            ->setFormatterIgnoreEmptyContextAndExtra($data[static::FORMATTER_IGNORE_EMPTY_CONTEXT_AND_EXTRA])
            ->setHandlerLoggerLevel($data[static::HANDLER_LOGGER_LEVEL])
            ->setHandlerBubble($data[static::HANDLER_BUBBLE]);
    }

    private function setFormatterOutputLength($formatterOutputLength)
    {
        that($formatterOutputLength)
            ->integerish()
            ->range(0, 918);

        $this->formatterOutputLength = $formatterOutputLength;

        return $this;
    }

    private function setFormatterFormat($formatterFormat)
    {
        thatNullOr($formatterFormat)
            ->string()
            ->notEmpty();

        $this->formatterFormat = $formatterFormat;

        return $this;
    }

    private function setFormatterDateFormat($formatterDateFormat)
    {
        $tester = new \DateTime;
        if ($formatterDateFormat !== null and $tester->format($formatterDateFormat) === false) {
            throw new InvalidArgumentException('Invalid date format', 0, null, $formatterDateFormat);
        }

        $this->formatterDateFormat = $formatterDateFormat;

        return $this;
    }

    private function setFormatterAllowInlineLineBreaks($formatterAllowInlineLineBreaks)
    {
        Assertion::boolean($formatterAllowInlineLineBreaks);

        $this->formatterAllowInlineLineBreaks = $formatterAllowInlineLineBreaks;

        return $this;
    }

    private function setFormatterIgnoreEmptyContextAndExtra($formatterIgnoreEmptyContextAndExtra)
    {
        Assertion::boolean($formatterIgnoreEmptyContextAndExtra);

        $this->formatterIgnoreEmptyContextAndExtra = $formatterIgnoreEmptyContextAndExtra;

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
            ->integerish()
            ->min(1);

        $this->senderTo = $senderTo;

        return $this;
    }

    private function setSenderClient(Client $senderClient)
    {
        $this->senderClient = $senderClient;

        return $this;
    }
}
