<?php namespace IlluminePlugin1\Wordpress;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illumine\Framework\Assembler;
class UnInstall{

    protected $this;
    private $plugin;

    /**
     * Class Initialization called by Hook (Requires Static Method)
     * @return UnInstall
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
        $this->plugin = Assembler::getInstance(__NAMESPACE__);
        $this->schema();
        $this->data();
    }

    /**
     * Modify Database Schema
     */
    private function schema()
    {

        if($this->plugin['config']->get('session.enabled') && $this->plugin['config']->get('session.driver') == 'database'){
            Schema::dropIfExists($this->plugin['config']->get('session.table'));
        }

        if($this->plugin['config']->get('cache.enabled') && $this->plugin['config']->get('cache.default') == 'database'){
            Schema::dropIfExists($this->plugin['config']->get('cache.stores.database.table'));
        }

        if($this->plugin['config']->get('queue.enabled') && $this->plugin['config']->get('queue.default') == 'database'){
            Schema::dropIfExists($this->plugin['config']->get('queue.connections.database.table'));
            Schema::dropIfExists('failed_jobs');
        }
    }

    /**
     * Remove Misc Data
     */
    private function data()
    {

    }
}