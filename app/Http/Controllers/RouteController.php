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

        $this->queue()->push((new \IlluminePlugin1\Jobs\Notify(array('email' => 'fdsf@gmail.com'))));

        $this->view('widget');

    }

}

