<?php

namespace My\Services;

use My\Engine\Service;

class Auth extends Service {

    /**
     * @var array connectors
     */
    public $connectors;

    public $methods = [
        'login'      => '/login/',
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
}
