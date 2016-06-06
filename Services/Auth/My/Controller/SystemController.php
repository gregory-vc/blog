<?php

namespace My\Controller;

use My\Engine\Response;
use My\Engine\Storage;

class SystemController {

    /**
     * @var Response
     */
    private $response;

    public function __construct()
    {
        $this->response = Storage::get('Response');
    }

    public function notFound()
    {
        return $this->response->json([
            'error' => 'not found'
        ]);
    }
}