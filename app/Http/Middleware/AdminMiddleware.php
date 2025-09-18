<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    protected array $allowedRoles = ['admin', 'venue_manager'];

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && in_array(Auth::user()->role, $this->allowedRoles)) {
            return $next($request);
        }

        return redirect('/')
            ->with('error', '你沒有權限訪問此頁面');
    }
}
