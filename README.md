# SMSAPI Monolog Handler And Formatter

## About
[Monolog](//github.com/Seldaek/monolog) Handler and Formatter to send logs using [SMSAPI](//smsapi.pl).
`monolog-smsapi` is [SemVer 2.0.0](//semver.org/spec/v2.0.0.html) compatible.

## Installation
```bash
composer require smsapi/monolog-smsapi:^0.2.2
```

## Usage
```php
use MonologSmsapi\SmsapiHandlerBuilder;
use Monolog\Logger;

$configData = [
    SmsapiConfig::SENDER_CLIENT => new Client(''),
    SmsapiConfig::SENDER_FROM => 'Info',
    SmsapiConfig::SENDER_TO => 0,
];

$handlerBuilder = new SmsapiHandlerBuilder;
$handler = $handlerBuilder->buildFromNativeConfig($config);

$logger = new Logger('example');
$logger->pushHandler($handler);
$logger->addCritical('critical bug');
```

## Changelog
[Changelog](CHANGELOG.md)

## License
[Apache 2.0 License](LICENSE)
