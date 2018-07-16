<?php


namespace App\Service\Security;


use DataProvider\CredentialsDataProvider;
use App\User\Exception\UserException;
use App\User\UserFacade;
use Xervice\Service\Middleware\Security\Exception\AuthenticationFailed;
use Xervice\Service\Middleware\Security\Validator\ValidatorInterface;

class MyAppAuthValidator implements ValidatorInterface
{
    /**
     * @var \App\User\UserFacade
     */
    private $userFacade;

    /**
     * DatabaseAuthValidator constructor.
     *
     * @param \App\User\UserFacade $userFacade
     */
    public function __construct(UserFacade $userFacade)
    {
        $this->userFacade = $userFacade;
    }

    /**
     * @param string $token
     *
     * @throws \Xervice\Service\Middleware\Security\Exception\AuthenticationFailed
     */
    public function validate(string $token): void
    {
        $credentials = $this->decrypt($token);

        try {
            $this->userFacade->loginUser($credentials);
        }
        catch (UserException $e) {
            throw new AuthenticationFailed();
        }
    }

    /**
     * @param string $token
     *
     * @return \DataProvider\CredentialsDataProvider
     * @throws \Xervice\Service\Middleware\Security\Exception\AuthenticationFailed
     */
    private function decrypt(string $token)
    {
        if (!$token || strpos($token, ':') === false) {
            throw new AuthenticationFailed();
        }
        $data = explode(':', $token);

        $credentials = new CredentialsDataProvider();
        return $credentials->setEmail($data[0])
                           ->setPassword($data[1]);
    }
}