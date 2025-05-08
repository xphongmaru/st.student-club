<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\models\User;
use App\Enums\StatusUser;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Session;
use App\Services\SsoService;

class AuthenticateController extends Controller
{
    function redirectToSSO()
    {
        $query = http_build_query([
            'client_id' => config('auth.sso.client_id'),
            'redirect_uri' => route('sso.callback'),
            'response_type' => 'code',
            'scope' => '',
        ]);
        return redirect(config('auth.sso.uri') . '/oauth/authorize?' . $query);
    }

    function handleSSOCallback(Request $request)
    {
        try {
            $data = $this->getAccessToken($request->code);
            if($data['access_token'] == null){
                return abort(401);
            }

            Session::put('access_token', $data['access_token']);
            $userData = $this->getUserData($data['access_token']);

            $user = $this->findOrCreateUser($userData, $data['access_token']);
            $this->storeSessionData($userData);

            Auth::login($user);

            return redirect()->route('client.index');
        }
        catch (Throwable $e) {
            Log::error('SSO Authentication Error: ' . $e->getMessage());
            return abort(401);
        }
    }

    private function getAccessToken(string $code): array
    {
        $response = Http::asForm()->post(config('auth.sso.uri') . '/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('auth.sso.client_id'),
            'client_secret' => config('auth.sso.client_secret'),
            'redirect_uri' => route('sso.callback'),
            'code' => $code,
        ]);
        return $response->json();
    }

    private function getUserData(string $accessToken): array
    {
        $response = Http::withToken($accessToken)->get(config('auth.sso.uri') . '/api/user');
        return $response->json();
    }

    private function findOrCreateUser(array $userData, string $accessToken): User
    {
        $user = User::query()->where('sso_id', $userData['id'])->first();

        $facultyId = null;
        if ($userData['role'] !== UserRole::SuperAdmin->value && !empty($userData['faculty_id'])) {
            $facultyId = $userData['faculty_id'];
        }

        $role = Role::query()->where('name', $userData['role'])->first();
        if (!$role) {
            Role::query()->create([
                'name' => $userData['role'],
            ]);
        }

        $code = "0";
        if($userData['role']== UserRole::Student->value && !empty($userData['code'])){
            $code = $userData['code'];
        }
        else{
            $code = "0";
        }

        if (!$user) {
            $user = User::query()->create([
                'sso_id' => $userData['id'],
                'status' => $userData['status'],
                'full_name' => $userData['full_name'],
                'access_token' => $accessToken,
                'code' => $code,
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'faculty_id' => $facultyId,
            ]);
            $user->userRoles()->attach($role->id);
        }
        else{
            User::query()->where('sso_id', $userData['id'])->update([
                'full_name' => $userData['full_name'],
                'access_token' => $accessToken,
                'code' => $code,
                'email' => $userData['email'],
                'phone' => $userData['phone'],
            ]);
            $user->userRoles()->sync($role->id);
        }

        return $user;
    }

    public function logout()
    {
        app(SsoService::class)->ClearAuth();
        return redirect(config('auth.sso.uri'));
    }


    private function storeSessionData(array $userData):void
    {
        Session::put('userData', $userData);
    }
}
