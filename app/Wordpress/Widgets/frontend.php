<?php
/**
 * @var \IllumineFramework\Factories\WidgetFactory $widgets
 **/

$widgets->add(
    'my_cool_widget',
    'My Widget',
    array(
        'classname' => 'my_widget',
        'description' => 'My Widget is awesome',
    ),
    \IlluminePlugin1\Http\Controllers\FrontWidgetController::class
);


