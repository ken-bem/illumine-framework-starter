<?php namespace IlluminePlugin1\Http\Controllers;
use IlluminePlugin1\Models\WpPost;
use IlluminePlugin1\Http\Requests\UserRequest;

class RouteController extends Controller {

    protected $this;

    public function __construct()
    {
        //Parent Constructor Binds Plugin Container to Class
        parent::__construct();

    }


    public function test(UserRequest $request)
    {

        $count = 0;
        while($count < 45){
            $this->queue()->push((new \IlluminePlugin1\Jobs\Notify(array('email' => str_random(10))))->onQueue('default'));
            $count++;
        }

        echo $count.' Jobs Pushed to Queue. '.$this->plugin['queue.worker']->getManager()->connection('database')->size().' Items are in the queue.';

    }

}

