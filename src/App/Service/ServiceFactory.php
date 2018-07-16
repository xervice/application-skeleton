<?php


namespace App\Service;


use App\Service\Security\MyAppUnauthResponse;
use Xervice\Service\ServiceFactory as XerviceServiceFactory;

class ServiceFactory extends XerviceServiceFactory
{
    public function createSecurityUnauthorizedResponse()
    {
        return new MyAppUnauthResponse();
    }

}