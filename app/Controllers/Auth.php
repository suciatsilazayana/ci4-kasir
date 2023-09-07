<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function register()
    {
        $data = array(
            'title' => 'Register',
        );
        return view('v_register');
    }
}
