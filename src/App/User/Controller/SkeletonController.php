<?php


namespace App\User\Controller;


use DataProvider\CredentialsDataProvider;
use DataProvider\UserDataProvider;
use Xervice\Service\Controller\AbstractApiController;

class SkeletonController extends AbstractApiController
{
    /**
     * @return \Xervice\Service\Application\Response\ApiResponse
     */
    public function registerSekeleton()
    {
        $dataProvider = new UserDataProvider();
        $dataProvider->setEmail('user@email.de')
                     ->setPassword('password')
                     ->setCompany('Company')
                     ->setFirstname('Firstname')
                     ->setLastname('Lastname');

        return $this->jsonResponse($dataProvider);
    }

    /**
     * @return \Xervice\Service\Application\Response\ApiResponse
     */
    public function loginSekeleton()
    {
        $dataProvider = new CredentialsDataProvider();
        $dataProvider->setEmail('user@email.de')
                     ->setPassword('password');

        return $this->jsonResponse($dataProvider);
    }

    /**
     * @return \Xervice\Service\Application\Response\ApiResponse
     */
    public function changePasswordSkeleton()
    {
        $dataProvider = new CredentialsDataProvider();
        $dataProvider->setEmail('user@email.de')
                     ->setPassword('new-password');

        return $this->jsonResponse($dataProvider);
    }
}