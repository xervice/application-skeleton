<?php


namespace App\Service\Security;


use DataProvider\ApiErrorDataProvider;
use Illuminate\Http\Request;
use Xervice\Service\Application\Response\ApiResponse;
use Xervice\Service\Middleware\Security\Response\SecurityUnauthorizedResponseInterface;

class MyAppUnauthResponse extends ApiResponse implements SecurityUnauthorizedResponseInterface
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function setSecurityResponse(Request $request): void
    {
        $errorDataProvider = new ApiErrorDataProvider();
        $errorDataProvider->setCode(2000)
                          ->setType('Api')
                          ->setMessage('Unauthorized')
                          ->setStatusCode(401);

        $this->setDataProvider($errorDataProvider);
    }

}