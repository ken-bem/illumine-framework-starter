<?php
/**
 * @var \Illuminate\Config\Repository $config
 * @var \IllumineFramework\Traits\AccessibleTrait $plugin
 **/

//add_action('save_post', function($post_id) use ($plugin){
//    if(!wp_is_post_revision($post_id)){
//        $plugin->cache()->flush();
//    }
//}, 99);