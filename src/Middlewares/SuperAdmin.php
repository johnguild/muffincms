<?php

namespace Johnguild\Muffincms\Middlewares;

use Auth;
use Closure;

class SuperAdmin
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->id != 1) {
            flash('danger', 'You are not authorized');
            return redirect('/');
        }

        return $next($request);
    }

}
