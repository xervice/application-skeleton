<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Xervice\Core\Locator\Locator;

if (!getenv('APPLICATION_PATH')) {
    putenv('APPLICATION_PATH='.dirname(__DIR__));
}

$locator = Locator::getInstance();
$kernel = $locator->kernel()->facade();

try {
    $kernel->boot();
    $kernel->run();
} catch (\Exception $e) {
    $locator->exceptionHandler()->facade()->handleException($e);
}