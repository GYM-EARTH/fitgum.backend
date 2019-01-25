<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 1/24/19
 * Time: 8:53 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            /** @var User $user */
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success]);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }


}
