<?php


namespace App\User\Controller;


use DataProvider\CredentialsDataProvider;
use App\Application\Controller\AuthApiController;

/**
 * @method \App\User\UserFacade getFacade()
 */
class AccountController extends AuthApiController
{
    /**
     * @param \DataProvider\CredentialsDataProvider $dataProvider
     *
     * @return \Xervice\Service\Application\Response\ApiResponse
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \App\User\Exception\UserException
     */
    public function changePasswordAction(CredentialsDataProvider $dataProvider)
    {
        $dataProvider = $this->getFacade()->changePassword($dataProvider);

        return $this->jsonResponse($dataProvider);
    }
}