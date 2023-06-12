<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RolePermission;

class CheckDeleteRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoleId = RolePermission::select('role_id')
                        ->whereIn('permission_id', [8, 9])
                        ->get()
                        ->pluck('role_id')
                        ->toArray();

        $authRoleId = auth()->user()->role_id;

        if (in_array($authRoleId, $allowedRoleId)) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
