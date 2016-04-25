<?php
namespace MonologSmsapi;

use Monolog\Formatter\NormalizerFormatter;

class SmsapiFormatter extends NormalizerFormatter
{
    private $outputLength;

    public function __construct(SmsapiConfig $smsapiConfig)
    {
        $this->outputLength = $smsapiConfig->formatterOutputLength;

        parent::__construct($smsapiConfig->formatterDateFormat);
    }

    public function format(array $record)
    {
        $output = parent::format($record);

        return substr($output, 0, $this->outputLength);
    }
}
