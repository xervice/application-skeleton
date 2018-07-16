<?php


namespace App\User;


use App\User\Model\Account;
use App\User\Model\Password;
use App\User\Model\User;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \App\User\UserConfig getConfig()
 */
class UserFactory extends AbstractFactory
{
    /**
     * @return \App\User\Model\Account
     */
    public function createAccountModel()
    {
        return new Account(
            $this->createPasswortModel()
        );
    }

    /**
     * @return \App\User\Model\User
     */
    public function createUserModel()
    {
        return new User(
            $this->createPasswortModel()
        );
    }

    /**
     * @return \App\User\Model\Password
     */
    public function createPasswortModel()
    {
        return new Password();
    }
}