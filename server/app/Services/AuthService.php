<?php

namespace App\Services;

use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Classes\Common;

use Auth;
use Exception;

class AuthService
{
    public static function login($credentials, $loginUsingId = false)
    {
        $output = new \stdClass();

        try
        {
            if($loginUsingId === true)
            {
                $user  = $credentials;
                $token = JWTAuth::fromUser($user);

                # somehow using JWTAuth::fromUser instead of JWTAuth::attempt does not automatically
                # logins the user, so we need to manually log in the user below.

                Auth::loginUsingId($user->id);
            }
            else
            {
                $token = JWTAuth::attempt($credentials);
            }

            if(!$token)
            {
                $output->responseData = ['error' => 'invalid_credentials'];
                $output->statusCode   = 401;
                return $output;
            }

            $currentUser    = Auth::user();

            // unset($currentUser->password);

            // if no errors are encountered we can return a JWT
            $output->responseData = [
                'token' => $token,
                'user'  => $currentUser,
                'expires' => 10800
            ];
            $output->statusCode = 200;
            return $output;

        } catch(JWTException $e) {
            $output->responseData = ['error' => 'could_not_create_token'];
            $output->statusCode = 500;

        } catch(Exception $e) {
            $output->responseData = ['error' => Common::generateExceptionArray($e)];
            $output->statusCode = 500;
            return $output;
        }
    }
}
