<?php


namespace App\Application;


use App\Application\Kernel\Kernel;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \App\Application\ApplicationFactory getFactory()
 */
class ApplicationFacade extends AbstractFacade
{
    public function getKernel(): Kernel
    {
        return $this->getFactory()->createKernel();
    }
}