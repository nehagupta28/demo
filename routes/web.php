<?php
$router->get('/', function () use ($router) {
    return $router->app->version();
});
 $router->post('/login', 'LoginController@login');
  $router->post('/register', 'UserController@register');
  $router->get('/user',['middleware' =>'auth', 'uses' => 'UserController@get_user' ]);
  $router->get('post',  ['uses' => 'PostController@showAllPost']);

  $router->get('post/{post_id}', ['uses' => 'PostController@showOnePost']);

  $router->post('post', ['uses' => 'PostController@create']);

  $router->delete('post/{post_id}', ['uses' => 'PostController@delete']);

  $router->put('post/{post_id}', ['uses' => 'PostController@update']);

  $router->get('users/{id}/post', ['uses' => 'PostController@listByUser']);

