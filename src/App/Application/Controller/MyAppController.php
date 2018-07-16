<?php


namespace App\Application\Controller;


use DataProvider\ApiErrorDataProvider;
use Illuminate\Http\Request;
use App\Application\Exception\MyAppException;
use Xervice\Service\Controller\AbstractApiController;

abstract class MyAppController extends AbstractApiController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param string $method
     * @param mixed ...$params
     *
     * @return \DataProvider\ApiErrorDataProvider|mixed
     * @throws \Xervice\Service\Controller\Exception\ApiControllerException
     */
    public function apiAction(Request $request, string $method, ...$params)
    {
        try {
            return parent::apiAction($request, $method, ...$params);
        } catch (MyAppException $exception) {
            return $this->jsonResponse(
                $this->getApiErrorDataProvider($exception, get_class($this))
            );
        }
    }


    /**
     * @param \Exception $exception
     * @param string $type
     *
     * @return \DataProvider\ApiErrorDataProvider
     */
    protected function getApiErrorDataProvider(\Exception $exception, string $type): ApiErrorDataProvider
    {
        $errorDataProvider = new ApiErrorDataProvider();
        $errorDataProvider->setCode($exception->getCode())
                          ->setType($type)
                          ->setMessage($exception->getMessage());

        if (method_exists($exception, 'getStatusCode')) {
            $errorDataProvider->setStatusCode($exception->getStatusCode());
        }

        return $errorDataProvider;
    }
}