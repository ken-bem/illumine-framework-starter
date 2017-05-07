<?php namespace IlluminePlugin1\Wordpress;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use IllumineFramework\IlluminePlugin;

class DeActivate{

    protected $this;
    private $plugin;

    /**
     * Class Initialization called by Hook (Requires Static Method)
     * @return DeActivate
     */
    public function init()
    {
        return new self();
    }

    /**
     * Class Constructor called by init()
     * Get instance of plugin using namespace & call methods
     */
    public function __construct()
    {
        $this->plugin = IlluminePlugin::getInstance(__NAMESPACE__);
        $this->schema();
        $this->data();
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {
        Schema::dropIfExists('illumine_test1');
        Schema::dropIfExists('illumine_test1_sessions');
        Schema::dropIfExists('illumine_test1_cache');
    }
    /**
     * Process Misc Data
     */
    public function data()
    {

    }
}