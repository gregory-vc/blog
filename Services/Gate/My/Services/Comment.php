<?php

namespace My\Services;

use My\Engine\Service;

class Comment extends Service {

    /**
     * @var array connectors
     */
    public $connectors;

    public $methods = [
        'find'      => '/comments/',
    ];

    public function __construct()
    {
        $this->connectors = [
            [
                'host' => getenv('COMMENT_1_HOST'),
                'port' => getenv('COMMENT_1_PORT')
            ],
            [
                'host' => getenv('COMMENT_2_HOST'),
                'port' => getenv('COMMENT_2_PORT')
            ]
        ];
    }
}
