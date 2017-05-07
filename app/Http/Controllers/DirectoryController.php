<?php namespace IlluminePlugin1\Http\Controllers;
use IlluminePlugin1\Models\WpPost;
class DirectoryController extends Controller {

    protected $this;
    public $data, $attributes;

    /**
     * DirectoryController constructor.
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

        $postType = (!is_null($this->attributes['parameters']['post_type']) ? $this->attributes['parameters']['post_type'] : 'page');

        $this->data = WpPost::with('meta')
            ->where('post_type', '=', $postType)
            ->where('post_status', '=', 'publish')
            ->where('post_title', 'like', '%'.$this->request()->get('post_title').'%')
            ->paginate(20, ['*'], 'wpp_directory1', $this->request()->get('wpp_directory1'));

        //$this->cache()->forever('testCache','fooBar');
        //$this->cookie()->queue($this->cookie()->forget('testCookie'));

    }


    /**
     * Display Directory Index
     * @return \Illuminate\Support\HtmlString string
     */
    public function template()
    {

        $this->view('directory', array(
            'posts' => $this->data
        ));

    }

}

