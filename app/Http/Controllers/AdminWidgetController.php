<?php namespace IlluminePlugin1\Http\Controllers;
class AdminWidgetController extends Controller {

    protected $this;
    public $attributes;

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
        //Parent Constructor Binds Plugin Container to Class
        parent::__construct();

        //Assign Attributes
        $this->attributes = $attributes;

        //Process Data
        $this->data();

        //Render Template
        $this->template();
    }

    /**
     * Load Data
     * @return void
     */
    public function data()
    {
        //Do Something Fancy!
    }

    /**
     * Display View
     * @return \Illuminate\Support\HtmlString string
     */
    public function template()
    {
        $this->view('widget');
    }

}

