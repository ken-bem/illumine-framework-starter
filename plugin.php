<?php
/**
 * @link              http://www.wordpresspluginpro.com
 * @since             1.0
 * @package           wpp-framework
 * @wordpress-plugin
 *
 * Plugin Name:       Illumine Plugin 1
 * Plugin URI:        http://www.wordpresspluginpro.com/
 * Description:       Basic Plugin Skeleton for New Projects.
 * Version:           1.0
 * Author:            Some Dev
 * Author URI:        http://www.SomeDev.com/
 * License:           © Copyright 2017 All Rights Reserved.
 * License URI:       http://www.SomeDev.com/terms
 * Text Domain: illumine-plugin1
 * Domain Path: /language
 */

/*
|--------------------------------------------------------------------------
| Require The Composer AutoLoader
|--------------------------------------------------------------------------
*/
require_once __DIR__.'/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Initialize Illumine Framework -- Pass In Current Plugin Directory
| Similar to Laravel's bootstrap/app.php
|--------------------------------------------------------------------------
*/

$framework = new \Illumine\Framework\Assembler(__FILE__);


/*
|--------------------------------------------------------------------------
| Register your own classes into the container before loading if needed.
| Access the class using the helper method:
| \MyPlugin\IllumineHelper::plugin('fooBar')->method();
|--------------------------------------------------------------------------
*/

//$framework->plugin->bind('fooBar', \stdClass::class, $shared = true|false);


/*
|--------------------------------------------------------------------------
| Load Translation Domain
|--------------------------------------------------------------------------
*/

//Add i18 Language Support
load_plugin_textdomain('illumine', false, 'illumine-plugin1/language/' );


/*
|--------------------------------------------------------------------------
| Boot the plugin instance.
|--------------------------------------------------------------------------
*/

$framework->bootInstance();