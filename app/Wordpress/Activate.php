<?php namespace IlluminePlugin1\Wordpress;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illumine\Framework\Assembler;
class Activate{

    protected $this;
    private $plugin;

    /**
     * Class Initialization called by Hook
     * @return Activate
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
        //$this->data();
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {

        //Check Version of Database
        if(!version_compare(mb_substr(DB::connection()->getPdo()->query('select version()')->fetchColumn(), 0, 6), '5.7.7') >= 0){
            //Set Schema String Length
            Schema::defaultStringLength(191);
        }

        //Add Session Table if Configured
        if($this->plugin['config']->get('session.enabled') && $this->plugin['config']->get('session.driver') == 'database'){
            //Create Sessions Table
            if(!Schema::hasTable($this->plugin['config']->get('session.table'))){
                Schema::create($this->plugin['config']->get('session.table'), function (Blueprint $table) {
                    $table->string('id')->unique();
                    $table->unsignedInteger('user_id')->nullable();
                    $table->string('ip_address', 45)->nullable();
                    $table->text('user_agent')->nullable();
                    $table->text('payload');
                    $table->integer('last_activity');
                });
            }
        }

        //Add Cache Table if Configured
        if($this->plugin['config']->get('cache.enabled') && $this->plugin['config']->get('cache.default') == 'database'){
            //Create Cache Table
            if(!Schema::hasTable($this->plugin['config']->get('cache.stores.database.table'))){
                Schema::create($this->plugin['config']->get('cache.stores.database.table'), function (Blueprint $table) {
                    $table->string('key')->unique();
                    $table->text('value');
                    $table->integer('expiration');
                });
            }
        }


        //Add Queue Table if Configured
        if($this->plugin['config']->get('queue.enabled') && $this->plugin['config']->get('queue.default') == 'database'){
            //Create Queue Table
            if(!Schema::hasTable($this->plugin['config']->get('queue.connections.database.table'))){
                Schema::create($this->plugin['config']->get('queue.connections.database.table'), function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->string('queue');
                    $table->longText('payload');
                    $table->tinyInteger('attempts')->unsigned();
                    $table->unsignedInteger('reserved_at')->nullable();
                    $table->unsignedInteger('available_at');
                    $table->unsignedInteger('created_at');
                    $table->index(['queue', 'reserved_at']);
                });
                Schema::create('failed_jobs', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->text('connection');
                    $table->text('queue');
                    $table->longText('payload');
                    $table->longText('exception');
                    $table->timestamp('failed_at')->useCurrent();
                });
            }
        }
    }

    /**
     * Insert Starter Data
     */
    public function data()
    {

    }


}