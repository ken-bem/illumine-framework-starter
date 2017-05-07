<?php namespace IlluminePlugin1\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use IllumineFramework\Controllers\BaseController;
use IlluminePlugin1\Helper;


class Controller extends BaseController{

    /**
     * Default Controller Class
     */
    public function test()
    {
        echo 'cool!';
    }
}