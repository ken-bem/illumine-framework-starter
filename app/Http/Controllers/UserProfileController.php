<?php namespace IlluminePlugin1\Http\Controllers;
use Illuminate\Validation\ValidationException;
use IlluminePlugin1\Models\WpUser;
use IlluminePlugin1\Http\Requests\UserRequest;
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

        $request = UserRequest::capture();

        if($request->isMethod('put')) {

            try {

                $request->validate();

                $this->attributes['user']->fill($request->only(['display_name']));
                if ($this->attributes['user']->save()) {
                    $this->attributes['alertClass'] = 'green';
                    $this->attributes['messages'] = array('Profile updated Successfully.');
                }

            } catch (ValidationException $validationException) {

                foreach($validationException->validator->errors()->all() as $field => $messages){

                    $this->attributes['messages'][$field] = $messages;
                }
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

