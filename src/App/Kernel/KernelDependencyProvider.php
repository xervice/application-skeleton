<?php


namespace App\Kernel;


use Xervice\Database\Kernel\DatabaseService;
use Xervice\Kernel\KernelDependencyProvider as XerviceKernelDependencyProvider;
use Xervice\Redis\Kernel\RedisService;
use Xervice\Session\Business\Kernel\SessionService;
use Xervice\Web\Business\Kernel\WebService;

class KernelDependencyProvider extends XerviceKernelDependencyProvider
{
    /**
     * @return array
     */
    protected function getServiceList(): array
    {
        return [
            'redis'    => RedisService::class,
            'session'  => SessionService::class,
            'database' => DatabaseService::class,
            'web'      => WebService::class
        ];
    }
}