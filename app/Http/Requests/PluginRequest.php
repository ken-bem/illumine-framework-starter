<?php
namespace IlluminePlugin1\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illumine\Framework\Assembler;
use Illumine\Framework\Traits\ReflectibleTrait;

class PluginRequest extends Request implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;
    use ReflectibleTrait;
    /**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $plugin;
    /**
     * The redirector instance.
     *
     * @var \Illuminate\Routing\Redirector
     */
    protected $redirector;
    /**
     * The URI to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirect;
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute;
    /**
     * The controller action to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectAction;
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'default';
    /**
     * The input keys that should not be flashed on redirect.
     *
     * @var array
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    public function __construct(array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->plugin = Assembler::getInstance($this->reflect()->getNamespaceName());
        $this->setRedirector(new \Illuminate\Routing\Redirector($this->plugin['url']));

        $this->redirector->setSession($this->plugin['session']->driver($this->plugin['config']->get('session.driver')));

        $this->validate();
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $factory = $this->plugin['validator'];
        if (method_exists($this, 'validator')) {
            $validator = $this->plugin->call([$this, 'validator'], compact('factory'));
        } else {
            $validator = $this->createDefaultValidator($factory);
        }
        if (method_exists($this, 'withValidator')) {
            $this->withValidator($validator);
        }
        return $validator;
    }
    /**
     * Create the default validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Factory  $factory
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        return $factory->make(
            $this->validationData(), $this->plugin->call([$this, 'rules']),
            $this->messages(), $this->attributes()
        );
    }
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->all();
    }



    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {

        throw new ValidationException($validator, $this->response(
            $this->formatErrors($validator)
        ));
    }
    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse($errors, 422);
        }else{

            return $this->redirector->to($this->getRedirectUrl())
                ->withInput($this->except($this->dontFlash))
                ->withErrors($errors, $this->errorBag);
        }
    }
    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        return $validator->getMessageBag()->toArray();
    }
    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        $url = $this->plugin['url'];


        if ($this->redirect) {
            return $url->to($this->redirect);
        } elseif ($this->redirectRoute) {
            return $url->route($this->redirectRoute);
        } elseif ($this->redirectAction) {
            return $url->action($this->redirectAction);
        }else{
            return $url->previous();
        }
    }
    /**
     * Determine if the request passes the authorization check.
     *
     * @return bool
     */
    protected function passesAuthorization()
    {
        if (method_exists($this, 'authorize')) {
            return $this->plugin->call([$this, 'authorize']);
        }
        return false;
    }
    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     */
    protected function failedAuthorization()
    {
        if($this->plugin->routeDispatched){
            wp_die('UnAuthorized');
        }else{
            $this->failedValidation($this->getValidatorInstance());
        }
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }
    /**
     * Set the Redirector instance.
     *
     * @param  \Illuminate\Routing\Redirector  $redirector
     * @return $this
     */
    public function setRedirector(Redirector $redirector)
    {
        $this->redirector = $redirector;
        return $this;
    }

    /**
     * Verify CSRF Token Presence
     * @return boolean
     */
    public function verifyCSRF()
    {

        if (!$this->isMethod('get') && $this->get('_token') == $this->plugin['session']->get('_token')) {
            $this->plugin['session']->regenerateToken();
            $this->plugin['session']->save();
            return true;
        } else {
            return false;
        }

    }
}