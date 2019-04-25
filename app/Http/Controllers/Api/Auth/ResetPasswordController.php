<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'User was not found.'
            ], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
            ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function reset($token)
    {
        $passwordReset = PasswordReset::where([
            ['token', $token],
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'status' => 'ERROR',
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'status' => 'ERROR',
                'message' => 'User was not found.'
            ], 404);
        $newPassword = str_random(7);
        $user->password = \Hash::make($newPassword);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($newPassword));
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Password was changed. '
        ]);
    }
}
