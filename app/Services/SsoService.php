<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Throwable;

class SsoService
{
    private $accessToken;
    public function __construct(){
        $this->accessToken = Session::get('access_token');
    }

    public function ClearAuth():void
    {
        Auth::logout();
        Session::forget('access_token');
        Session::forget('user_data');
        Session::forget('club_id');
    }

    public function get(string $endPoint, $data = [])
    {
        try {
            $response = Http::withToken($this->accessToken)->get(config('auth.sso.uri') . $endPoint, $data);

            dd($response->json());
        } catch (Throwable $th) {
            Log::error($th->getMessage());

            $this->handleError($th->getCode());

            return [];
        }
    }

    private function handleError(int $codeError): void
    {

        if (401 === $codeError) {
            $this->clearAuth();
            abort(401);
        }

        if (404 === $codeError) {
            abort(404);
        }

        if (500 === $codeError) {
            abort(500);
        }

        if (403 === $codeError) {
            abort(403);
        }

    }

}
