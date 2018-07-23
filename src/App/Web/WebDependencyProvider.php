<?php


namespace App\Web;


use App\Application\Business\Plugin\RoutesPlugin;
use Xervice\Web\WebDependencyProvider as XerviceWebDependencyProvider;

class WebDependencyProvider extends XerviceWebDependencyProvider
{
    /**
     * @return array
     */
    protected function getRouteProvider(): array
    {
        return [
            new RoutesPlugin()
        ];
    }
}