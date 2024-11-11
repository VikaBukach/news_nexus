<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
//
//        // Перевірка, чи аутентифіковано через guard admin
//        if (!auth::guard('admin')->check()) {
//            return redirect()->route('admin.login');
//        }

//        return $next($request);

        return $next($request);
    }
}
