<?php


namespace App\Application;


use Xervice\Core\Factory\AbstractFactory;
use Xervice\Logger\LoggerFacade;
use Xervice\Session\SessionClient;

/**
 * @method \App\Application\ApplicationConfig getConfig()
 */
class ApplicationFactory extends AbstractFactory
{
    /**
     * @return \Xervice\Session\SessionClient
     */
    public function getSessionClient(): SessionClient
    {
        return $this->getDependency(ApplicationDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return \Xervice\Logger\LoggerFacade
     */
    public function getLoggerFacade(): LoggerFacade
    {
        return $this->getDependency(ApplicationDependencyProvider::LOG_FACADE);
    }
}