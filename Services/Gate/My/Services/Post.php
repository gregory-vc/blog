<?php

namespace My\Services;

use My\Engine\Service;

class Post extends Service{

    /**
     * @var array connectors
     */
    public $connectors;

    public $methods = [
        'all'   => '/posts/',
        'find'  => '/post/'
    ];

    public function __construct()
    {
        $this->connectors = [
            [
                'host' => getenv('POST_1_HOST'),
                'port' => getenv('POST_1_PORT')
            ],
            [
                'host' => getenv('POST_2_HOST'),
                'port' => getenv('POST_2_PORT')
            ]
        ];
    }
}
