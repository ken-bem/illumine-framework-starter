<?php namespace IlluminePlugin1\Http\Requests;
use Closure;
use IlluminePlugin1\Http\Requests\PluginRequest;
class UserRequest extends PluginRequest
{

    public static function handle($request, Closure $next)
    {
        return $next($request);
    }

}
