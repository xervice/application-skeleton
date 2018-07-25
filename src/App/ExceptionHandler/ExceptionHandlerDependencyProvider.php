<?php


namespace App\ExceptionHandler;


use App\Application\Business\ExceptionHandler\LogExceptionHandler;
use Xervice\ExceptionHandler\ExceptionHandlerDependencyProvider as XerviceExceptionHandlerDependencyProvider;

class ExceptionHandlerDependencyProvider extends XerviceExceptionHandlerDependencyProvider
{
    /**
     * @return array
     */
    public function getExceptionHandler(): array
    {
        return [
            new LogExceptionHandler()
        ];
    }

}