<?php


namespace App\Application;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class ApplicationDependencyProvider extends AbstractProvider
{
    public const SESSION_FACADE = 'session.facade';

    public const SERVICE_FACADE = 'service.facade';

    public const DATABASE_FACADE = 'database.facade';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::SERVICE_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->service()->facade();
        };

        $dependencyProvider[self::DATABASE_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->database()->facade();
        };
    }
}