<?php namespace IllumineFramework;
use IllumineFramework\Traits\AccessibleTrait;
use IllumineFramework\Traits\ReflectibleTrait;

abstract class IllumineHelper{
    use ReflectibleTrait;
    use AccessibleTrait;

    protected $this, $namespace, $plugin;


    private function __construct()
    {
        $this->plugin = illumine($this->reflect()->getNamespaceName());

    }

    /**
     * Get Session Token
     * @return string
     */
    public static function token()
    {
        $helper = new static();
        return $helper->getToken();
    }

    /**
     * Build URL for Route
     * @return string
     */
    public static function route_url($name, $parameters = null, $absolute = null)
    {
        $helper = new static();

        $helper->router()->getRoutes()->refreshNameLookups();

        return $helper->urlGenerator()->route($name, $parameters, $absolute);
    }

    /**
     * Build URL for Path
     * @return string
     */
    public static function url($path, $parameters = null, $secure = null)
    {
        $helper = new static();

        return $helper->urlGenerator()->to($path, $parameters, $secure);
    }


    /**
     * Build URL for Path
     * @return string
     */
    public static function asset($path, $parameters = null, $secure = null)
    {
        $helper = new static();

        return $helper->urlGenerator()->asset($helper->config()->get('public').'/'.$path);
    }


}


