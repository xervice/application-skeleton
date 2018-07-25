<?php


namespace App\Application\Business\Plugin;


use App\Application\Business\Controller\IndexController;
use DataProvider\RouteCollectionDataProvider;
use Xervice\Controller\Business\Route\AbstractControllerProvider;

class RoutesPlugin extends AbstractControllerProvider
{
    /**
     * @param \DataProvider\RouteCollectionDataProvider $dataProvider
     *
     * @return \DataProvider\RouteCollectionDataProvider
     */
    public function handleRoutes(RouteCollectionDataProvider $dataProvider): RouteCollectionDataProvider
    {
        $dataProvider->addRoute(
            $this->addController(
                '/',
                IndexController::class,
                'indexAction',
                [
                    'GET'
                ]
            )
        );

        $dataProvider->addRoute(
            $this->addController(
                '/set/{name}',
                IndexController::class,
                'nameAction',
                [
                    'GET'
                ]
            )
        );

        return $dataProvider;
    }
}
