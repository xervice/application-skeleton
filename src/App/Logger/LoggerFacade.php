<?php


namespace App\Logger;


use DataProvider\LogMessageDataProvider;
use Xervice\Logger\LoggerFacade as XerviceLoggerFacade;

/**
 * @method \App\Logger\LoggerFactory getFactory()
 */
class LoggerFacade extends XerviceLoggerFacade
{
    /**
     * @param \Exception $exception
     *
     * @return \DataProvider\LogMessageDataProvider
     */
    public function getLogMessageFromException(\Exception $exception): LogMessageDataProvider
    {
        return $this->getFactory()->createExceptionConverter()->convert($exception);
    }
}