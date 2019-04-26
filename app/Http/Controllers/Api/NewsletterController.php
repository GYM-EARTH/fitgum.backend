<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 4/25/19
 * Time: 8:47 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Notifications\NewsletterConfirmation;
use Illuminate\Http\Request;
use Notification;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        if (Newsletter::where('email', $request->get('email'))->activated()->first()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Email was added before',
            ]);
        }

        $newsletter = Newsletter::updateOrCreate(
            [
                'email' => $request->get('email'),
            ],
            [
                'email' => $request->get('email'),
                'token' => str_random(60),
                'status' => Newsletter::STATUS_WAIT,
            ]
        );


        if (!$newsletter) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Error adding record',
            ]);
        }

        $newsletter->notifyNow(
            new NewsletterConfirmation($newsletter->email, $newsletter->token)
        );
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'We have e-mailed your confirmation link!'
        ]);
    }

    public function confirm($email, $token)
    {
        $newsletter = Newsletter::where([
            ['email', $email],
            ['token', $token],
        ])->wait()->first();
        if (!$newsletter)
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Confirmation token is invalid.'
            ], 404);
        $newsletter->token = null;
        $newsletter->status = Newsletter::STATUS_ACTIVE;
        $newsletter->save();
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Success.'
        ]);
    }
}
