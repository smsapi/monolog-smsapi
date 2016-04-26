# SMSAPI Monolog Handler And Formatter

## About
[Monolog](//github.com/Seldaek/monolog) Handler and Formatter to send logs using [SMSAPI](//smsapi.pl).
[SemVer 2.0.0](//semver.org/spec/v2.0.0.html) compatible.

## Installation
```bash
composer require smsapi.pl/monolog-smsapi:^0.1
```

## Usage
```php
$configData = [
    SmsapiConfig::SENDER_CLIENT => new Client(''),
    SmsapiConfig::SENDER_FROM => 'Info',
    SmsapiConfig::SENDER_TO => 0,
];
$config = new SmsapiConfig($configData);

$handlerBuilder = new SmsapiHandlerBuilder;
$handler = $handlerBuilder->buildFromConfig($config);

$logger = new Logger('example');
$logger->pushHandler($handler);
$logger->addCritical('critical bug');
```

## Changelog
[Changelog](CHANGELOG.md)

## License
[Apache 2.0 License](LICENSE)
