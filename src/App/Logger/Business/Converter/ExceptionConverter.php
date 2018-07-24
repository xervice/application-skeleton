<?php


namespace App\Logger\Business\Converter;


use DataProvider\LogMessageDataProvider;

class ExceptionConverter implements ExceptionConverterInterface
{
    /**
     * @param \Exception $exception
     *
     * @return \DataProvider\LogMessageDataProvider
     */
    public function convert(\Exception $exception)
    {
        $logMessage = new LogMessageDataProvider();

        $logMessage
            ->setTitle(get_class($exception))
            ->setMessage($exception->getMessage())
            ->setContext($exception->getTraceAsString());

        return $logMessage;
    }
}