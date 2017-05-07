<?php namespace IlluminePlugin1\Http\Controllers;
use IlluminePlugin1\Models\WpUser;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller {

    public $attributes = array(), $content = '';

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

        $this->attributes['user'] = WpUser::find(get_current_user_id());
        $this->attributes['errors'] = null;
        $this->attributes['alertColor'] = 'red';



        if($this->request()->isMethod('put')){

            $data = $this->request()->only(['display_name', '_token']);

            $rules = array(
                'display_name' => array('required', Rule::unique('users')->ignore($this->attributes['user']->ID, 'ID')),
                '_token' => 'required'
            );

            $messages = array(
                'display_name.required' => 'A display name is required.',
                'display_name.unique' => 'A display name must be unique.',
                '_token.required' => 'A Security Token must be present.'
            );

            $validation = $this->validator()->make($data,$rules,$messages);


            if($validation->passes() && $this->verifyCSRF()) {

                $this->attributes['user']->fill($data);

                if($this->attributes['user']->save()) {
                    $this->attributes['alertClass'] = 'green';
                    $this->attributes['messages'] = array('Profile updated Successfully.');
                }

            }elseif(count($validation->errors()) > 0){

                $this->attributes['messages'] = $validation->errors()->all();

            }else{
                $this->attributes['messages'] = array('CSRF Token Expired Please refresh the page to start a new request.');
            }
        }
    }

    /**
     * Render Shortcode Template
     * @return mixed
     */
    public function template()
    {
        $this->view('forms.profile',$this->attributes);
    }

}

