<?php


namespace App\Application;


use App\Application\Kernel\Kernel;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\Database\DatabaseFacade;
use Xervice\Service\ServiceFacade;

class ApplicationFactory extends AbstractFactory
{
    /**
     * @return \App\Application\Kernel\Kernel
     */
    public function createKernel(): Kernel
    {
        return new Kernel(
            $this->getServiceFacade(),
            $this->getDatabaseFacade()
        );
    }

    /**
     * @return \Xervice\Database\DatabaseFacade
     */
    public function getDatabaseFacade(): DatabaseFacade
    {
        return $this->getDependency(ApplicationDependencyProvider::DATABASE_FACADE);
    }

    /**
     * @return \Xervice\Service\ServiceFacade
     */
    public function getServiceFacade(): ServiceFacade
    {
        return $this->getDependency(ApplicationDependencyProvider::SERVICE_FACADE);
    }
}