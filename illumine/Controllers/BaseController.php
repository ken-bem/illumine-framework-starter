<?php namespace IllumineFramework\Controllers;

use Illuminate\Routing\Controller;
use IllumineFramework\IlluminePlugin;
use IllumineFramework\Traits\AccessibleTrait;
use IllumineFramework\Traits\ReflectibleTrait;
abstract class BaseController extends Controller{

    use ReflectibleTrait;
    use AccessibleTrait;

    protected
        $this,
        $plugin,
        $config,
        $session,
        $filesystem,
        $router,
        $routeDispatched,
        $currentUserId,
        $request,
        $response,
        $cookieJar,
        $cookies,
        $view,
        $viewRendered,
        $validator;
    /**
     * BaseController constructor.
     * @param $namespace (optional)
     * Allows Framework to Load the BuiltIn Dev Controller
     */
    public function __construct($namespace = null)
    {
        $this->plugin = IlluminePlugin::getInstance((is_null($namespace) ? $this->reflect()->getNamespaceName() : $namespace));
        $this->cookies = array();
        $this->viewRendered = null;
    }
}