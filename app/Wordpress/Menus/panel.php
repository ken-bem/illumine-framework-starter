<?php
/**
 * @var \IllumineFramework\Factories\AdminFactory $admin
 **/


$admin->addPanel(
    'my-menu', //pageTitle
    'MyMenu', //menuTitle
    null, //capability
    '#', //slug
    null, //callback
    101 //priority
);
