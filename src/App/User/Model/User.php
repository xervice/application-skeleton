<?php


namespace App\User\Model;


use DataProvider\CredentialsDataProvider;
use DataProvider\UserDataProvider;
use Orm\Xervice\User\Persistence\User as OrmUser;
use Orm\Xervice\User\Persistence\UserQuery;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;
use App\User\Exception\UserException;

class User
{
    /**
     * @var \App\User\Model\Password
     */
    private $passwordModel;

    /**
     * User constructor.
     *
     * @param \App\User\Model\Password $passwordModel
     */
    public function __construct(Password $passwordModel)
    {
        $this->passwordModel = $passwordModel;
    }

    /**
     * @param \DataProvider\UserDataProvider $dataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \App\User\Exception\UserException
     */
    public function createUser(UserDataProvider $dataProvider)
    {
        $this->validateEmail($dataProvider);
        $this->checkUserExists($dataProvider);
        $this->validatePassword($dataProvider);

        $dataProvider->setPassword(
            $this->passwordModel->encryptPassword($dataProvider->getPassword())
        );

        $newUser = new OrmUser();

        $dataProvider->unsetUserId();
        $dataProvider->unsetToken();
        $newUser->fromArray($dataProvider->toArray());
        $newUser->save();

        $dataProvider->fromArray($newUser->toArray());


        return $dataProvider;
    }

    /**
     * @param \DataProvider\CredentialsDataProvider $dataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \App\User\Exception\UserException
     */
    public function loginUser(CredentialsDataProvider $dataProvider): UserDataProvider
    {
        $this->validateLoginRequirements($dataProvider);

        $userQuery = UserQuery::create();
        $user = $userQuery->findOneByEmail($dataProvider->getEmail());

        if (!$user) {
            $e = new UserException('Login failed', 1004);
            $e->setStatusCode(401);
            throw $e;
        }

        if (
            !$this->passwordModel->verifyPassword(
                $dataProvider->getPassword(),
                $user->getPassword()
            )
        ) {
            $e = new UserException('Login failed', 1004);
            $e->setStatusCode(401);
            throw $e;
        }

        $userDataProvider = new UserDataProvider();
        $userDataProvider->fromArray($user->toArray());
        $userDataProvider->setToken(
            base64_encode(
                $userDataProvider->getEmail() . ':' . $dataProvider->getPassword()
            )
        );

        return $userDataProvider;
    }

    /**
     * @param \DataProvider\UserDataProvider $dataProvider
     *
     * @throws \App\User\Exception\UserException
     */
    private function checkUserExists(UserDataProvider $dataProvider): void
    {
        $userQuery = UserQuery::create();
        $user = $userQuery->findOneByEmail($dataProvider->getEmail());

        if ($user) {
            $e = new UserException('User already exists', 1000);
            $e->setStatusCode(400);
            throw $e;
        }
    }

    /**
     * @param \DataProvider\UserDataProvider $dataProvider
     *
     * @throws \App\User\Exception\UserException
     */
    private function validatePassword(UserDataProvider $dataProvider): void
    {
        if (strlen($dataProvider->getPassword()) < 8) {
            $e = new UserException('Password must have at least 8 signs', 1002);
            $e->setStatusCode(400);
            throw $e;
        }
    }

    /**
     * @param \DataProvider\UserDataProvider $dataProvider
     *
     * @throws \App\User\Exception\UserException
     */
    private function validateEmail(UserDataProvider $dataProvider): void
    {
        if (!$dataProvider->hasEmail()) {
            $e = new UserException('User must have an email address', 1001);
            $e->setStatusCode(400);
            throw $e;
        }
    }

    /**
     * @param \DataProvider\CredentialsDataProvider $dataProvider
     *
     * @throws \App\User\Exception\UserException
     */
    private function validateLoginRequirements(CredentialsDataProvider $dataProvider): void
    {
        if (!$dataProvider->hasEmail() || !$dataProvider->hasPassword()) {
            $e = new UserException('E-Mail and Password are required', 1003);
            $e->setStatusCode(400);
            throw $e;
        }
    }
}