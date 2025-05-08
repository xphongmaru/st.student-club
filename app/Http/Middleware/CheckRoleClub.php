<?php

namespace App\Http\Middleware;

use App\Models\Club;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class CheckRoleClub
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = Auth::user();
        $clubId = $request->route('id');
        $hasClub = $user->clubs()
            ->where('club_id', $clubId)->get();

        if ($hasClub->isEmpty()) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        $roles = $user->roleClubs()->where('user_id', $user->id)->get();

        $hasRoles=[];
        foreach ($roles as $role) {
            if($role->club_id == $clubId) {
                $hasRoles[] = $role;
            }
        }

        $hasPermission=false;
        foreach ($hasRoles as $role) {
            $hasPermission = $role->rolePermissionClubs()->where('name', $permission)->exists();
        }


        if (! $hasPermission) {
            abort(403, 'Bạn không có quyền truy cập.');
        }
        return $next($request);
    }
}
