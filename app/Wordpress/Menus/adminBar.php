<?php
/**
 * @var \IllumineFramework\Factories\AdminFactory $admin
 **/


$admin->addBarNode(
    'my-menu', //id
    'MyMenu', //title
    null, //parent_id
    '#', //href
    null, //group
    array( 'class' => 'fooBar'), //attributes
    101 //priority
);
