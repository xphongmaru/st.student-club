<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = Auth::user();

        $has = $user
            && $user->userRoles()
            ->whereHas('permissions', fn($q) =>
            $q->where('name', $permission)
            )->exists();

        if (! $has) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }

}
