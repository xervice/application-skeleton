<?php


namespace App\User;


use DataProvider\CredentialsDataProvider;
use DataProvider\UserDataProvider;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \App\User\UserFactory getFactory()
 * @method \App\User\UserConfig getConfig()
 * @method \App\User\UserClient getClient()
 */
class UserFacade extends AbstractFacade
{
    /**
     * @var \DataProvider\UserDataProvider
     */
    private $loggedUser;

    /**
     * @param \DataProvider\UserDataProvider $dataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \App\User\Exception\UserException
     */
    public function createUser(UserDataProvider $dataProvider)
    {
        return $this->getFactory()->createUserModel()->createUser($dataProvider);
    }

    /**
     * @param \DataProvider\CredentialsDataProvider $dataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \App\User\Exception\UserException
     */
    public function loginUser(CredentialsDataProvider $dataProvider)
    {
        $this->loggedUser = $this->getFactory()->createUserModel()->loginUser($dataProvider);

        return $this->loggedUser;
    }

    /**
     * @param \DataProvider\CredentialsDataProvider $dataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \App\User\Exception\UserException
     */
    public function changePassword(CredentialsDataProvider $dataProvider)
    {
        return $this->getFactory()->createAccountModel()->changePassword($dataProvider);
    }

    /**
     * @return \DataProvider\UserDataProvider
     */
    public function getLoggedUser()
    {
        return $this->loggedUser;
    }
}