<?php namespace IlluminePlugin1\Http\Requests;
use Illuminate\Validation\Rule;

class UserRequest extends PluginRequest
{
    public function authorize()
    {
        if($this->method() == 'PUT' && !$this->verifyCSRF()){
            return false;
        }
        return true;
    }

    public function rules()
    {

        if($this->method() == 'PUT'){

            return [
                'display_name' => array('required', Rule::unique('users')->ignore(get_current_user_id(), 'ID')),
                '_token' => 'required'
                ];
        }

        return [];

    }
    public function messages()
    {

        return [
            'display_name.required' => 'A display name is required.',
            'display_name.unique' => 'A display name must be unique.',
            '_token.required' => 'A Security Token must be present.'
        ];

    }
}
