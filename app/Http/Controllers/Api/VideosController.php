<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12/21/18
 * Time: 8:58 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        $items = Video::where('status', true)->paginate(30);

        return response()
            ->json($items);
    }

    public function show(Request $request, $slug)
    {
        $item = Video::where('slug', $slug)
            ->where('status', true)
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
}
