<?php
declare(strict_types=1);

/** @var \Laravel\Lumen\Routing\Router $router */

// MailChimp group
$router->group(['prefix' => 'mailchimp', 'namespace' => 'MailChimp'], function () use ($router) {
    // Lists group
    $router->group(['prefix' => 'lists'], function () use ($router) {
        $router->post('/', 'ListsController@create');
        $router->get('/{listId}', 'ListsController@show');
        $router->put('/{listId}', 'ListsController@update');
        $router->delete('/{listId}', 'ListsController@remove');
    });

    //List members group
    $router->group(['prefix' => 'lists/{listId}/members'], function () use ($router) {
        $router->post('/', 'ListMembersController@create');
        $router->get('/{listMemberId}', 'ListMembersController@show');
        $router->put('/{listMemberId}', 'ListMembersController@update');
        $router->patch('/{listMemberId}', 'ListMembersController@update');
        $router->delete('/{listMemberId}', 'ListMembersController@remove');
    });
});
