<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 3/19/19
 * Time: 9:48 AM
 */

namespace App\Http\Controllers\Api;


use App\Events\Message;
use App\Models\Chat\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Messages
{
    public function store(Request $request)
    {
        $userId = Auth::id();

        $message = $request->get('message');
        $chatId = $request->get('chatId');
        $receivers = explode(', ', $request->get('receivers'));

        if (empty($receivers)) {
            return response()->json(['ERROR' => 'Receivers empty']);
        }

        if (empty($message)) {
            return response()->json(['ERROR' => 'Message empty']);
        }

        $chat = Chat::find($chatId);

        if (empty($chat)) {
            $chat = Chat::whereHas('users', function ($query) use ($userId, $receivers) {
                $query->where('user_id', $userId)
                    ->whereIn('user_id', $receivers);
            })->first();

            if (null === $chat) {
                $allUsers = array_merge($receivers, [$userId]);
                $chat = $this->createChat($allUsers);
            }
        }

        $chat->messages()->create([
            'user_id' => $userId,
            'message' => $message,
        ]);

        foreach ($receivers as $receiver) {
            broadcast(new Message($receiver, [
                'message' => $message,
                'from' => $userId,
            ]));
        }

    }

    public function get(Request $request, Chat $chat)
    {
        return response()->json($chat->messages);
    }

    private function createChat(array $users)
    {
        /** @var Chat $chat */
        $chat = Chat::create(['type' => Chat::TYPE_PRIVATE]);
        foreach ($users as $user) {
            $chat->users()->attach($user);
        }
        $chat->save();
        return $chat;

    }
}
