<?php

namespace App\Logger\Business\Converter;

interface ExceptionConverterInterface
{
    /**
     * @param \Exception $exception
     *
     * @return \DataProvider\LogMessageDataProvider
     */
    public function convert(\Exception $exception);
}