<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    //以cookie方式发送csrf-token,每个表单默认发送
    public function handle($request, Closure $next)
    {
        return parent::addCookieToResponse($request, $next($request)); // TODO: Change the autogenerated stub
    }
}
