<?php namespace IlluminePlugin1\Http\Controllers;
class FrontWidgetController extends Controller {

    protected $this;
    public $attributes;

    /**
     * Dashboard Widget
     * @param $attributes (WidgetAttributes)
     *
     * Available Attributes:
     * $this->attributes['id'], //Widget ID
     * $this->attributes['name'],  //Widget Name
     * $this->attributes['parameters'],  //Css
     */
    public function __construct($attributes = array())
    {
        //Parent Constructor Binds Plugin Container to Class
        parent::__construct();

        //Assign Attributes
        $this->attributes = $attributes;
    }

    /**
     * Display Widget View (WP Required Method)
     * @return \Illuminate\Support\HtmlString string
     */
    public function widget($args, $instance)
    {
        $this->view('widget');
    }

    /**
     * Display Form View (WP Required Method)
     * @return \Illuminate\Support\HtmlString string
     */
    public function form($instance)
    {
       $this->view('widget');
    }

    /**
     * Update Data (WP Required Method)
     * @return $new_instance
     */
    public function update($new_instance, $old_instance){

        return $new_instance;
    }
}

