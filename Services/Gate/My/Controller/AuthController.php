<?php

namespace My\Controller;

use My\Services\Auth;
use My\Engine\Redirect;

class AuthController extends MainController{

    public function login()
    {
        return $this->response->html('login');
    }

    public function auth()
    {
        $token = Auth::post('login', $this->request->post);
        if (empty($token['content'])) {
            throw new \Exception('Not found user');
        }
        $this->session->set('user', $token['content']);
        Redirect::go('/');
    }
}