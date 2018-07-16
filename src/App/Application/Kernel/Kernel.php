<?php


namespace App\Application\Kernel;


use Xervice\Database\DatabaseFacade;
use Xervice\Service\ServiceFacade;
use Xervice\Session\SessionFacade;

class Kernel
{
    /**
     * @var ServiceFacade
     */
    private $serviceFacade;

    /**
     * @var \Xervice\Database\DatabaseFacade
     */
    private $databaseFacade;

    /**
     * Kernel constructor.
     *
     * @param ServiceFacade $serviceFacade
     * @param \Xervice\Database\DatabaseFacade $databaseFacade
     */
    public function __construct(
        ServiceFacade $serviceFacade,
        DatabaseFacade $databaseFacade
    ) {
        $this->serviceFacade = $serviceFacade;
        $this->databaseFacade = $databaseFacade;
    }


    public function boot(): void
    {
        $this->databaseFacade->initDatabase();
        $this->serviceFacade->registerHandler();
    }

    public function run(): void
    {
        $this->serviceFacade->startApplication();
    }
}