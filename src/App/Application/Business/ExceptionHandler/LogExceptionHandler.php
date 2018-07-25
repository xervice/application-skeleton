<?php


namespace App\Application\Business\ExceptionHandler;


use DataProvider\LogMessageDataProvider;
use Xervice\Core\Factory\FactoryInterface;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface;

/**
 * @method \App\Application\ApplicationFactory getFactory()
 */
class LogExceptionHandler extends AbstractWithLocator implements ExceptionHandlerInterface
{

    /**
     * @param \Exception $exception
     * @param bool $isDebug
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function handleException(\Exception $exception, bool $isDebug): void
    {
        $logMessage = new LogMessageDataProvider();
        $logMessage
            ->setTitle(get_class($exception))
            ->setMessage($exception->getMessage())
            ->setContext($exception->getTraceAsString());

        $this->getFactory()->getLoggerFacade()->log($logMessage);
    }

}