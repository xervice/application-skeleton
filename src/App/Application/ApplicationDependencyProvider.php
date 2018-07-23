<?php


namespace App\Application;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class ApplicationDependencyProvider extends AbstractProvider
{
    public const SESSION_CLIENT = 'session.client';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::SESSION_CLIENT] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->session()->client();
        };
    }
}