<?php

namespace My\Engine;

use My\App;

/**
 * Class Session
 * @package My\Engine
 * 
 * 
 * @TODO Rewrite by Redis
 */

class Session {
    
    public $session_id;

    public function __construct()
    {
        session_start();
        $this->session_id = session_id();
    }
    
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function clean()
    {
        session_unset();
    }
}
