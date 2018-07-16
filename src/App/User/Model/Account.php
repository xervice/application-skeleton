<?php


namespace App\User\Model;


use DataProvider\CredentialsDataProvider;
use DataProvider\UserDataProvider;
use Orm\Xervice\User\Persistence\UserQuery;
use App\User\Exception\UserException;

class Account
{
    /**
     * @var \App\User\Model\Password
     */
    private $passwordModel;

    /**
     * Account constructor.
     *
     * @param \App\User\Model\Password $passwordModel
     */
    public function __construct(\App\User\Model\Password $passwordModel)
    {
        $this->passwordModel = $passwordModel;
    }

    /**
     * @param \DataProvider\CredentialsDataProvider $dataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \App\User\Exception\UserException
     */
    public function changePassword(CredentialsDataProvider $dataProvider)
    {
        $userQuery = UserQuery::create();
        $user = $userQuery->findOneByEmail($dataProvider->getEmail());

        if (!$user) {
            $e = new UserException('User not found', 3000);
            $e->setStatusCode(400);
            throw $e;
        }

        $newPassword = $this->passwordModel->encryptPassword($dataProvider->getPassword());
        $user->setPassword($newPassword);
        $user->save();

        $userDataProvider = new UserDataProvider();
        $userDataProvider->fromArray($user->toArray());
        $userDataProvider->setToken(
            base64_encode(
                $userDataProvider->getEmail() . ':' . $dataProvider->getPassword()
            )
        );

        return $userDataProvider;
    }
}