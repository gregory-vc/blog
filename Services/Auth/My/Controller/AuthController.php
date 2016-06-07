<?php

namespace My\Controller;

use My\Engine\Response;
use My\Engine\Storage;
use My\Engine\Request;
use My\Model\Comment;
use My\Model\Post;
use My\Service\Auth;

class AuthController {

    /**
     * @var Response
     */
    private $response;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Auth
     */
    private $auth;
    
    public function __construct()
    {
        $this->response = Storage::get('Response');
        $this->request = Storage::get('Request');
        $this->auth = Storage::get('Auth');
    }

    public function login()
    {
        $login = '';
        if (!empty($this->request->post['login'])) {
            $login = $this->request->post['login'];
        }
        $password = '';
        if (!empty($this->request->post['password'])) {
            $password = $this->request->post['password'];
        }
        $result = $this->auth->login($login, $password);
        return $this->response->json($result);
    }

    public function validate()
    {
        $token = $this->request->getParam('token');
        $result = $this->auth->validate($token);
        return $this->response->json($result);
    }
}