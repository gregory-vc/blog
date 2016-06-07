<?php

namespace My\Services;

use My\Engine\Service;

class Auth extends Service {

    /**
     * @var array connectors
     */
    public $connectors;

    public $methods = [
        'validate_token'      => '/validate_token/',
    ];

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
    }
    
    static public function validatePost($post)
    {
        if (!empty($post['token'])) {
            $token = $post['token'];
            $is_login = Auth::get('validate_token', [
                'token' => $token
            ]);
            if (!empty($is_login['content']['validate_result'])) {
                return true;
            } else {
                throw new \Exception('Token not validate');
            }
        } else {
            throw new \Exception('Token not set');
        }
    }
}
