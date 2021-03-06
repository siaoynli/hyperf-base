<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\HyperfController@index');

Router::get('/favicon.ico', function () {
    return '';
});


Router::addGroup('/v1', function () {

    Router::get('/', 'App\Controller\IndexController@index');
    Router::get('/user/{id}', 'App\Controller\UserController@index');
    Router::get('/user', 'App\Controller\UserController@update');


    Router::get('/article/index', 'App\Controller\ArticleController@index');
    Router::get('/article', 'App\Controller\ArticleController@create');
});
