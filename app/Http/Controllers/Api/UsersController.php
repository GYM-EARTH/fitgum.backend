<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 5/15/19
 * Time: 7:59 AM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $items = User::with('userRole')
            ->paginate(30);

        return response()
            ->json($items);
    }

    public function show($userId)
    {
        $item = User::with('userRole')
            ->find($userId);

        if (!$item) {
            return response()
                ->json(['error' => 404, 'message' => 'Not found'], 404);
        }

        $item->save();

        return response()->json($item->toArray());
    }

    public function trainers()
    {
        $items = User::with('userRole')
            ->where('role_id', 3)
            ->paginate(30);

        return response()
            ->json($items);
    }
}
