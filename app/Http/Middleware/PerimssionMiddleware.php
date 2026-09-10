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
 public function handle(Request $request, Closure $next, string $permission): Response
{
    $user = $request->user();
    $role = $user ? $user->role : null;
    
    $hasPermission = $role && $role->permissions()->where('name', $permission)->exists();

    if (!$hasPermission) {
        $data = [
            "message" => "You do not have permission to perform this action.",
            "debug_user_id" => $user ? $user->id : 'Not Logged In',
            "debug_role" => $role ? $role->name : 'No Role Found',
            "debug_permission" => $permission,
            "status" => 403,
        ];
        return response()->json($data, 403);
    }

    return $next($request);
}
 }