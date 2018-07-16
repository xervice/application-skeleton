<?php


namespace App\Service\Security;


use Laravel\Lumen\Application;
use Xervice\Service\Middleware\Security\Authentication;
use Xervice\Service\Service\ServiceProviderInterface;

class MyAppSecurityProvider implements ServiceProviderInterface
{
    /**
     * @param \Laravel\Lumen\Application $app
     */
    public function register(Application $app)
    {
        $app->routeMiddleware(
            [
                'auth' => Authentication::class
            ]
        );
    }

}