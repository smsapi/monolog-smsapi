<?php
namespace MonologSmsapi;

use Monolog\Formatter\LineFormatter;

class SmsapiFormatter extends LineFormatter
{
    private $outputLength;

    public function __construct(SmsapiConfig $smsapiConfig)
    {
        $this->outputLength = $smsapiConfig->formatterOutputLength;

        parent::__construct(
            $smsapiConfig->formatterFormat,
            $smsapiConfig->formatterDateFormat,
            $smsapiConfig->formatterAllowInlineLineBreaks,
            $smsapiConfig->formatterIgnoreEmptyContextAndExtra
        );
    }

    public function format(array $record)
    {
        $record = parent::format($record);

        return substr($record, 0, $this->outputLength);
    }
}
