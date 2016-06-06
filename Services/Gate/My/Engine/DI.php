<?php

namespace My\Engine;

use My\App;

class DI {
    
    static public function start()
    {
        Storage::set('Request', new Request());
        Storage::set('Router', new Router());
        Storage::set('Redirect', new Redirect());
        Storage::set('App', new App());
        Storage::set('Response', new Response());
    }
}
