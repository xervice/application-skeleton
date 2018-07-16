<?php


namespace App\Application\Controller;


abstract class AuthApiController extends MyAppController
{

    /**
     * AuthApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}