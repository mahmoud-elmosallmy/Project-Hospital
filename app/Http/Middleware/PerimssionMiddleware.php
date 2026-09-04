<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerimssionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next,string $permission): Response
    {
        $user = $request->user();
        $role = $user->role;
        $permissions = $role->permissions;

        if (!$permissions->contains('name',$permission)) {
           $data = [
                "message" => "You do not have permission to perform this action.",
                "status" => 403,
           ];
           return response()->json($data,403);
        }
        return $next($request); 
    }
}
