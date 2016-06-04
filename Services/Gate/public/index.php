<?php

require '../vendor/autoload.php';

use My\Engine\DI;
use My\Engine\Storage;

DI::start();

$router = Storage::get('Router');

$router->get('/', 'PostController@all');
$router->get('/post/', 'PostController@get');
$router->post('/post/', 'PostController@add');
$router->post('/post/comment', 'CommentController@add');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@auth');
$router->get('/404', 'SystemController@notFound');
$router->post('/404', 'SystemController@notFound');

$app = Storage::get('App');
$app->run();