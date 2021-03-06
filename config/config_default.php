<?php

use Xervice\Logger\LoggerConfig;
use Xervice\Config\XerviceConfig;
use Xervice\Core\CoreConfig;
use Xervice\DataProvider\DataProviderConfig;
use Xervice\ExceptionHandler\ExceptionHandlerConfig;

$rootPath = dirname(__DIR__);


$config[CoreConfig::PROJECT_LAYER_NAMESPACE] = 'App';

$config[ExceptionHandlerConfig::IS_DEBUG] = true;

$config[LoggerConfig::LOG_PATH] = dirname(__DIR__) . '/data/logs';
$config[LoggerConfig::LOG_FILENAME] = 'application.log';

$config[DataProviderConfig::DATA_PROVIDER_GENERATED_PATH] = $rootPath . '/src/Generated';
$config[DataProviderConfig::DATA_PROVIDER_PATHS] = [
    $rootPath . '/src',
    $rootPath . '/vendor'
];

$config[DataProviderConfig::DATA_PROVIDER_GENERATED_PATH] = dirname(__DIR__) . '/src/Generated';
$config[DataProviderConfig::DATA_PROVIDER_PATHS] = [
    dirname(__DIR__) . '/src/',
    dirname(__DIR__) . '/vendor/',
];

$config[XerviceConfig::ADDITIONAL_CONFIG_FILES] = [
    __DIR__ . '/static/config_propel.php',
    __DIR__ . '/static/config_redis.php'
];
