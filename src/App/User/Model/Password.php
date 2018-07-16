<?php


namespace App\User\Model;


use DataProvider\UserPasswordDataProvider;

class Password
{
    /**
     * @param string $password
     *
     * @return string
     */
    public function encryptPassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $password
     * @param $hash
     *
     * @return bool
     */
    public function verifyPassword(string $password, $hash)
    {
        return password_verify($password, $hash);
    }
}