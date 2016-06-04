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
        $controller_template = $this->template_path.$name.'.php';
        $layout_template = $this->template_path.'layout.php';
        ob_start();
        require_once($controller_template);
        $contents = ob_get_contents();
        ob_end_clean();
        ob_start();
        require_once($layout_template);
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
