<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth('sanctum')->user();
        if (!$user){
            return response()->json([
                'success' => false,
                'message' => 'you are not logged in'
            ] , 404);
        } 
        if ($user->userType != "admin" ) {
            return response()->json([
                'success' => false,
                'message' => 'you are not authorized for admin panal. '
            ],404);
        }
        return $next($request);
    }
}
