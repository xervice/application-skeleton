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

    public const LOG_FACADE = 'log.facade';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::SESSION_CLIENT] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->session()->client();
        };

        $dependencyProvider[self::LOG_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->logger()->facade();
        };
    }
}