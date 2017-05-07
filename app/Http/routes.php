<?php
/**
 * @var \Illuminate\Routing\Router $route
 * @var \Illuminate\Http\Response $response
 **/

$route->get('/about/{page?}', 'IlluminePlugin1\Http\Controllers\DirectoryController@data')->name('directory');

//
//$route->any('/test2/', function() use ($response){
//    $response->create(\IlluminePlugin1\Models\WpPost::take(10)->select(['post_title'])->get(), 200)->send();
//});


$route->any('/test1/', 'IlluminePlugin1\Http\Controllers\Controller@test')->middleware(\IlluminePlugin1\Http\Middleware\CsrfFilter::class);