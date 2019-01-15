<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12/21/18
 * Time: 8:58 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $items = Category::where('status', true)
            ->paginate(30);

        return response()
            ->json($items);
    }

    public function show(Request $request, $slug)
    {
        /** @var Category $item */
        $item = Category::where('status', true)
            ->where('slug', $slug)
            ->first();

        if (!$item) {
            return response()
                ->json(['error' => 404, 'message' => 'Not found'], 404);
        }

        $item->views += 2;
        $item->save();

        return response()
            ->json($item->news);
    }
}
