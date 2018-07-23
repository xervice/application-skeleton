<?php

use Xervice\Database\DatabaseConfig;
use Xervice\Redis\RedisConfig;

$config[RedisConfig::REDIS_HOST] = '127.0.0.1';
$config[RedisConfig::REDIS_PORT] = 16379;
$config[RedisConfig::REDIS_PASSWORD] = '';
$config[RedisConfig::REDIS_DATABASE] = 0;


$config[DatabaseConfig::PROPEL_CONF_DIR] = __DIR__ . '/propel';

$config[DatabaseConfig::PROPEL_CONF_ADAPTER] = 'pgsql';
$config[DatabaseConfig::PROPEL_CONF_HOST] = 'appdb';
$config[DatabaseConfig::PROPEL_CONF_PORT] = '15432';
$config[DatabaseConfig::PROPEL_CONF_DBNAME] = 'dockerci';
$config[DatabaseConfig::PROPEL_CONF_USER] = 'dockerci';
$config[DatabaseConfig::PROPEL_CONF_PASSWORD] = 'dockerci';