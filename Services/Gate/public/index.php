<?php

require '../vendor/autoload.php';

use My\Engine\DI;
use My\Engine\Storage;

DI::start();

$router = Storage::get('Router');

$router->get('/', 'PostController@all');
$router->get('/post/', 'PostController@get');
$router->get('/post/add/', 'PostController@addPage');
$router->get('/login/', 'AuthController@login');
$router->get('/logout/', 'AuthController@logout');
$router->get('/404', 'SystemController@notFound');

$router->post('/post/add_request/', 'PostController@add');
$router->post('/comment/add_request/', 'CommentController@add');
$router->post('/login/send_request/', 'AuthController@auth');
$router->post('/404', 'SystemController@notFound');

$app = Storage::get('App');

try {
    $app->run();
} catch (\Exception $e) {
    print_r($e->getMessage());
}
