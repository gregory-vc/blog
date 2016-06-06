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
     * @var string get params
     */
    public $params;

    /**
     * @var string
     */
    public $method;

    /**
     * @var string post params
     */
    public $post;

    public function __construct()
    {
        $this->request_method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $parameters = parse_url($this->uri);
        if (!empty($parameters['query'])) {
            parse_str($parameters['query'], $query);
            $this->params = $query;
        }
        $this->uri = $parameters['path'];
        $this->post = $_POST;
    }
    
    public function getAllParam()
    {
        return $this->params;
    }

    public function getIntParam($name)
    {
        if (!empty($this->params[$name])) {
            return (int) $this->params[$name];
        } else {
            throw new \Exception('Params '.$name.' not found');
        }
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
