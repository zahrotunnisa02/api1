<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    
    // protected function redirectTo($request)
    // {
    //     // if (! $request->expectsJson()) {
    //     //     return route('login');
    //     // }

    protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        abort(response()->json([
            'message' => 'Unauthorized access. Please log in.'
        ], 401));
    }
}

}
