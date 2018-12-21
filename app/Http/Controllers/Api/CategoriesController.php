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
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', true)->paginate(30);

        return response()->json($categories);
    }

    public function show(Request $request, $slug)
    {
        $category = Category::where('status', true)->where('slug', $slug)->first();

        if (!$category) {
            return response()->json([ 'error'=> 404, 'message'=> 'Not found'], 404);
        }

        $category->views += 2;
        $category->save();

        return response()->json($category->toArray());
    }
}
