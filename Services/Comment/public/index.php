<?php

require '../vendor/autoload.php';

use My\Engine\DI;
use My\Engine\Storage;

try {
    DI::start();
    $router = Storage::get('Router');
    $router->get('/comments/', 'CommentController@all');
    $router->post('/comment/add/', 'CommentController@add');
    $router->get('/404', 'SystemController@notFound');
    $app = Storage::get('App');
    $app->run();
} catch (\Exception $e) {
    echo json_encode([
       'error' => $e->getMessage() 
    ]);
}
