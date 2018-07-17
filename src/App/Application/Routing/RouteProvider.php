<?php


namespace App\Application\Routing;


use Laravel\Lumen\Routing\Router;
use App\Application\Controller\StatusController;
use App\User\Controller\SkeletonController;
use App\User\Controller\UserController;
use Xervice\Service\Route\RouteInterface;

class RouteProvider implements RouteInterface
{
    public function register(Router $router)
    {
        $routings = [
            'post' => [
                [
                    '/api/user/{method}',
                    UserController::class,
                    'apiAction'
                ]
            ]
        ];

        $this->handleRoutings($router, $routings, 'get');
        $this->handleRoutings($router, $routings, 'post');
        $this->handleRoutings($router, $routings, 'delete');
        $this->handleRoutings($router, $routings, 'put');

        $this->skeletonRoutings($router);
    }

    /**
     * @param \Laravel\Lumen\Routing\Router $router
     */
    private function skeletonRoutings(Router $router): void
    {
        $router->get('/api/user/register/skeleton', SkeletonController::class . '@registerSekeleton');
    }

    /**
     * @param \Laravel\Lumen\Routing\Router $router
     * @param array $routings
     * @param string $type
     */
    private function handleRoutings(Router $router, array $routings, string $type): void
    {
        $routings[$type] = $routings[$type] ?? [];
        foreach ($routings[$type] as $route) {
            $this->createRoute($router, $route, $type);
        }
    }

    /**
     * @param \Laravel\Lumen\Routing\Router $router
     * @param $route
     */
    private function createRoute(Router $router, array $route, string $type): void
    {
        $router->$type($route[0], $route[1] . '@' . $route[2]);
    }

}