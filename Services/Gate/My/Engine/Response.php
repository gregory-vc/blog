<?php

namespace My\Engine;

class Response {

    /**
     * @var string path to template dir
     */
    private $template_path;

    /**
     * @var string
     */
    public $content;

    public function __construct()
    {
        $this->template_path = dirname(__FILE__).'/../Template/';
    }

    public function html($name, $data) {
        $this->template_path .= $name.'.php';
        ob_start();
        require_once($this->template_path);
        $contents = ob_get_contents();
        ob_end_clean();
        $this->content = $contents;
        return $this;
    }

    public function render()
    {
        echo $this->content;
    }
}
