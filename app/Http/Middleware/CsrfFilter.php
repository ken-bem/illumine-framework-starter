<?php namespace IlluminePlugin1\Http\Middleware;
use Closure;
use IlluminePlugin1\Helper;

class CsrfFilter{

    public function __construct(Helper $helper)
    {
        $this->plugin = $helper;
    }
    public function handle($request, Closure $next)
    {
        if($this->plugin->verifyCSRF()){

            //Continue Next Request
            return $next($request);

        }elseif($this->plugin->request()->header('REFERER')){

            //Redirect Back if Possible
            $this->plugin->redirect($this->plugin->request()->header('REFERER'));

        }else{

            //Show Error View: Forbidden
            $this->plugin->view('errors.forbidden');

        }
    }
}
