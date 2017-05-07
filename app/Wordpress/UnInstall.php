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
        Schema::dropIfExists('illumine_test1_sessions');
        Schema::dropIfExists('illumine_test1_cache');
    }

    /**
     * Remove Misc Data
     */
    private function data()
    {

    }
}