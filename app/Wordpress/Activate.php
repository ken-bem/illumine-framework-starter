<?php namespace IlluminePlugin1\Wordpress;

use IllumineFramework\IlluminePlugin;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class Activate{

    protected $this;
    private $plugin;

    /**
     * Class Initialization called by Hook (Requires Static Method)
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
        //$this->plugin = IlluminePlugin::getInstance(__NAMESPACE__);
        $this->schema();
        //$this->data();
    }

    /**
     * Modify Database Schema
     */
    public function schema()
    {

        $version = DB::connection()->getPdo()->query('select version()')->fetchColumn();

        if(!version_compare(mb_substr($version, 0, 6), '5.7.7') >= 0){
            Schema::defaultStringLength(191);
        }


        //Create Testing Table
        if(!Schema::hasTable('illumine_test1')){
            Schema::create('illumine_test1', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('password');
                $table->timestamps();
            });
            DB::table('illumine_test1')->insert([
                [
                    'name' => str_random(10),
                    'email' => str_random(10).'@gmail.com',
                    'password' => wp_hash_password('secret'),
                    'created_at' => current_time( 'mysql' ),
                    'updated_at' => current_time( 'mysql' ),
                ],
                [
                    'name' => str_random(10),
                    'email' => str_random(10).'@gmail.com',
                    'password' => wp_hash_password('secret'),
                    'created_at' => current_time( 'mysql' ),
                    'updated_at' => current_time( 'mysql' ),
                ],
                [
                    'name' => str_random(10),
                    'email' => str_random(10).'@gmail.com',
                    'password' => wp_hash_password('secret'),
                    'created_at' => current_time( 'mysql' ),
                    'updated_at' => current_time( 'mysql' ),
                ],
                [
                    'name' => str_random(10),
                    'email' => str_random(10).'@gmail.com',
                    'password' => wp_hash_password('secret'),
                    'created_at' => current_time( 'mysql' ),
                    'updated_at' => current_time( 'mysql' ),
                ]
            ]);

        }
        //Create Sessions Table
        if(!Schema::hasTable('illumine_test1_sessions')){
            Schema::create('illumine_test1_sessions', function (Blueprint $table) {
                $table->string('id')->unique();
                $table->unsignedInteger('user_id')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity');
            });
        }

        //Create Sessions Table
        if(!Schema::hasTable('illumine_test1_cache')){
            Schema::create('illumine_test1_cache', function (Blueprint $table) {
                $table->string('key')->unique();
                $table->text('value');
                $table->integer('expiration');
            });
        }

    }

    /**
     * Insert Starter Data
     */
    public function data()
    {

    }


}