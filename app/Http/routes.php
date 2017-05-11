<?php
/**
 * @var \Illuminate\Routing\Router $route
 * @var \Illuminate\Http\Response $response
 **/

//$route->get('/about/{page?}', 'IlluminePlugin1\Http\Controllers\DirectoryController@data')->name('directory');

//
//$route->any('/test2/', function() use ($response){
//    $response->create(\IlluminePlugin1\Models\WpPost::take(10)->select(['post_title'])->get(), 200)->send();
//});


//$route->any('/about/', 'IlluminePlugin1\Http\Controllers\Controller@test')->middleware(\IlluminePlugin1\Http\Middleware\CsrfFilter::class);
$route->any('/about/', 'IlluminePlugin1\Http\Controllers\RouteController@test');




with(new Illuminate\Queue\QueueServiceProvider($this->plugin))->register();

//$this->plugin['queue']->push('IlluminePlugin1\Jobs\Notify', array('email' => 'fdsf@gmail.com'));

$route->any('/api/queue', function(){

    $queue = $this->plugin['queue.worker'];

    $queue->runNextJob('database', 'default', new \Illuminate\Queue\WorkerOptions($delay = 0, $memory = 128, $timeout = 60, $sleep = 3, $maxTries = 0, $force = false));

});



