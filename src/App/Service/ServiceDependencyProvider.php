<?php


namespace App\Service;


use App\Application\Routing\RouteProvider;
use App\Service\Security\MyAppAuthValidator;
use App\Service\Security\MyAppSecurityProvider;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Service\ServiceDependencyProvider as XerviceServiceDependencyProvider;

class ServiceDependencyProvider extends XerviceServiceDependencyProvider
{
    /**
     * @return array|\Xervice\Service\Service\ServiceProviderInterface[]
     */
    protected function getApplicationServiceProvider()
    {
        return [
            new MyAppSecurityProvider()
        ];
    }


    /**
     * @return array|\Xervice\Service\Route\RouteInterface[]
     */
    protected function getRouteProvider()
    {
        return [
            new RouteProvider()
        ];
    }

    /**
     * @return array|\Xervice\Service\Handler\HandlerInterface[]
     */
    protected function getHandler()
    {
        return [];
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     *
     * @return array|\Xervice\Service\Middleware\Security\Validator\ValidatorInterface[]
     */
    protected function getBasicAuthValidator(DependencyProviderInterface $dependencyProvider)
    {
        return [
            new MyAppAuthValidator($dependencyProvider->getLocator()->user()->facade())
        ];
    }


}