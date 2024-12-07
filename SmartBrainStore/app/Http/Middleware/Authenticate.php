public function handle($request, Closure $next, $guard = null)
{
    if (Auth::guard($guard)->guest()) {
        return redirect()->route('login');
    }

    return $next($request);
}
