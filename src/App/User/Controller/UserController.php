<?php


namespace App\User\Controller;


use App\Application\Controller\MyAppController;
use DataProvider\CredentialsDataProvider;
use DataProvider\UserDataProvider;

/**
 * @method \App\User\UserFacade getFacade()
 */
class UserController extends MyAppController
{
    /**
     * @param \DataProvider\UserDataProvider $dataProvider
     *
     * @return \Xervice\Service\Application\Response\ApiResponse
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \App\User\Exception\UserException
     */
    public function registerAction(UserDataProvider $dataProvider)
    {
        $dataProvider = $this->getFacade()->createUser($dataProvider);

        return $this->jsonResponse($dataProvider);
    }

    /**
     * @param \DataProvider\CredentialsDataProvider $dataProvider
     *
     * @return \Xervice\Service\Application\Response\ApiResponse
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \App\User\Exception\UserException
     */
    public function loginAction(CredentialsDataProvider $dataProvider)
    {
        $dataProvider = $this->getFacade()->loginUser($dataProvider);

        return $this->jsonResponse($dataProvider);
    }
}