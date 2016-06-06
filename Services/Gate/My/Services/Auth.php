<?php

namespace My\Services;

use My\Engine\Service;
use My\Engine\Session;
use My\Engine\Storage;

class Auth extends Service {

    /**
     * @var array connectors
     */
    public $connectors;

    public $methods = [
        'login'      => '/login/',
    ];

    /**
     * @var Session
     */
    public $session;

    /**
     * @var array
     */
    public $user;

    public function __construct()
    {
        $this->connectors = [
            [
                'host' => getenv('AUTH_1_HOST'),
                'port' => getenv('AUTH_1_PORT')
            ],
            [
                'host' => getenv('AUTH_2_HOST'),
                'port' => getenv('AUTH_2_PORT')
            ]
        ];
        $this->session = Storage::get('Session');
        $this->user = $this->session->get('user');
    }

    static public function isLogin()
    {
        $auth = new static;
        return !empty($auth->user['login']);
    }

    static public function getUser()
    {
        $auth = new static;
        return $auth->user;
    }
}
