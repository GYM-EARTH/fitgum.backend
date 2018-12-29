<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12/21/18
 * Time: 8:58 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $items = Service::paginate(30);

        return response()
            ->json($items);
    }

    public function show(Request $request, $slug)
    {
        $item = Service::where('slug', $slug)
            ->first();

        if (!$item) {
            return response()
                ->json([ 'error'=> 404, 'message'=> 'Not found'], 404);
        }

        $item->save();

        return response()
            ->json($item->toArray());
    }
}
