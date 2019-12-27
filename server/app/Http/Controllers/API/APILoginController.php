<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\AuthService;

class APILoginController extends Controller
{
    //Please add this method
    public function login(Request $request) {

        $credentials = $request->only('email', 'password');
        $authAttempt = AuthService::login($credentials);
        return response()->json($authAttempt->responseData, $authAttempt->statusCode);
    }
}
