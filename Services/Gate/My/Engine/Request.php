<?php

namespace My\Engine;

class Request {

    /**
     * @var string get, post etc
     */
    public $request_method;

    /**
     * @var string current url
     */
    public $uri;

    /**
     * @var string
     */
    public $controller;

    /**
     * @var string
     */
    public $method;
    
    public function __construct()
    {
        $this->request_method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function setRoute($route)
    {
        $route = explode('@', $route);
        if (empty($route[0])) {
            throw new \Exception('Not found controller');
        }
        $this->controller = 'My\Controller\\'.$route[0];
        if (empty($route[1])) {
            throw new \Exception('Not found method controller');
        }
        $this->method = $route[1];
    }
}
