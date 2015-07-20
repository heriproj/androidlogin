<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if($request->method() == 'POST' || $request->method() == 'DELETE')
		{
		    return $next($request);
		}

		if ($request->method() == 'GET' || $this->tokensMatch($request))
		{
		    return $next($request);
		}
		throw new TokenMismatchException;
	}

}
