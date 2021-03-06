<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12/21/18
 * Time: 8:58 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubsController extends Controller
{
    public function index()
    {
        $data = [
            'body' => [
                'testField' => 'abc'
            ],
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id',
        ];


        $items = Club::where('status', true)->paginate(30);

        return response()
            ->json($items);
    }

    public function show(Request $request, $slug)
    {
        $item = Club::with('type')
            ->with('metros')
            ->with('clubServices')
            ->with('microServices')
            ->with('clubTimes')
            ->with('city')
            ->with('levels')
            ->with('clubPhotos')
            ->with('trainers')
            ->with('users')
            ->where('status', true)
            ->where('slug', $slug)
            ->first();

        if (!$item) {
            return response()
                ->json(['error' => 404, 'message' => 'Not found'], 404);
        }

        $item->views += 1;
        $item->save();

        return response()
            ->json($item->toArray());
    }

    public function attachUser($slug)
    {
        /** @var Club $item */
        $item = Club::where('slug', $slug)
            ->first();

        if (!$item) {
            return response()
                ->json(['error' => 404, 'message' => 'Not found'], 404);
        }

        $item->users()->attach(\Auth::id());

        try {
            $item->saveOrFail();
            return response()
                ->json([
                    'status' => 'SUCCESS',
                ]);
        } catch (\Throwable $exception) {
            return response()
                ->json([
                    'status' => 'ERROR',
                    'message' => $exception->getMessage(),
                ]);
        }
    }
}
