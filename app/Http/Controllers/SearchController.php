<?php namespace IlluminePlugin1\Http\Controllers;
class SearchController extends Controller {

    protected $this;
    public $data, $attributes, $parameters;

    /**
     * Shortcode constructor.
     * @param $attributes
     * $this->attributes['tag'] (Shortcode Tag Name)
     * $this->attributes['parameters'] (Shortcode Tag Parameters)
     * $this->attributes['content'] (Shortcode Tag Content)
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
     * Process Data
     * @return void
     */
    public function data()
    {
        //Assign Request Query to Template Variables
        $this->attributes['searchTerm'] = $this->request()->get('post_title');
    }

    /**
     * Display View
     * @return \Illuminate\Support\HtmlString string
     */
    public function template()
    {
        return $this->view('forms.search', $this->attributes);
    }

}

