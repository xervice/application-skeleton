<?php


namespace App\Application\Exception;


use Xervice\Core\Exception\XerviceException;

class MyAppException extends XerviceException
{
    /**
     * @var int
     */
    private $statusCode = 200;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }
}