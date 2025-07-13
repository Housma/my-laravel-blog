<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole{
        /**
         * Check if the authenticated user has 'user' or 'admin' role.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return \Symfony\Component\HttpFoundation\Response
         */
        public function handle(Request $request, Closure $next): Response
        {
            $user = $request->user();

            if (!$user || !in_array($user->role, ['user', 'admin'])) {
                abort(403, 'Unauthorized.');
            }

            return $next($request);
        }
 
}
