<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdministrator
{

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role !== User::ROLE_ADMINISTRATOR) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized action.');
        }
        return $next($request);
    }

}
