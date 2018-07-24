<?php


namespace App\Logger;


use App\Logger\Business\Converter\ExceptionConverter;
use App\Logger\Business\Converter\ExceptionConverterInterface;
use Xervice\Logger\LoggerFactory as XerviceLoggerFactory;

class LoggerFactory extends XerviceLoggerFactory
{
    /**
     * @return \App\Logger\Business\Converter\ExceptionConverterInterface
     */
    public function createExceptionConverter(): ExceptionConverterInterface
    {
        return new ExceptionConverter();
    }
}