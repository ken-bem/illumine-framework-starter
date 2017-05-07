<?php namespace IllumineFramework\Controllers;
class WidgetController extends AdminController {

    protected $this;
    public $id, $name;

    /**
     * Dashboard Widget
     * @param $attributes (WidgetAttributes)
     *
     * Available Attributes:
     * $this->attributes['id'], //Widget ID
     * $this->attributes['name'],  //Widget Name
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->attributes = $attributes;
        $this->data();
        $this->template();
    }

    /**
     * Get Widget Data
     * @return mixed
     */
    public function data()
    {

    }

    /**
     * Build Template
     * @echo string
     */
    public function template()
    {
        $this->view('admin.widgets.framework',$this->attributes);
    }

}

