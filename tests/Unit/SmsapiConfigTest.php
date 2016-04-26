<?php
namespace MonologSmsapi\Tests\Unit;

use Monolog\Logger;
use MonologSmsapi\SmsapiConfig;
use MonologSmsapi\Tests\Fixture\SmsapiConfigMother;
use PHPUnit_Framework_TestCase;

class SmsapiConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_accept_valid_formatter_date_format()
    {
        $validFormatterDateFormat = 'Y-m-d';

        SmsapiConfigMother::createWithGivenFormatterDateFormat($validFormatterDateFormat);

        $this->assertTrue(true);
    }
}
