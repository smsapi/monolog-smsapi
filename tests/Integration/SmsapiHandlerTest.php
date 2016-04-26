<?php
namespace MonologSmsapi\Tests\Integration;

use Monolog\Logger;
use MonologSmsapi\SmsapiFormatterFactory;
use MonologSmsapi\SmsapiHandler;
use MonologSmsapi\Tests\Double\MessageSenderSpy;
use MonologSmsapi\Tests\Fixture\SmsapiConfigMother;
use PHPUnit_Framework_TestCase;

class SmsapiHandlerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_sent_message()
    {
        $spy = new MessageSenderSpy;
        $config = SmsapiConfigMother::createDefault();
        $handler = new SmsapiHandler($spy, new SmsapiFormatterFactory($config), $config);
        $logger  = new Logger('example');
        $logger->pushHandler($handler);

        $logger->addCritical('some critical bug');

        $this->assertTrue($spy->isSent);
    }
}
