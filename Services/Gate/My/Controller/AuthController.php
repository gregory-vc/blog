<?php

namespace My\Controller;

use My\Services\Auth;

class AuthController extends MainController{

    public function login()
    {
        return $this->response->html('login');
    }

    public function auth()
    {
        $token = Auth::post('login', $this->request->post);
        print_r($token);
        die();
    }
}