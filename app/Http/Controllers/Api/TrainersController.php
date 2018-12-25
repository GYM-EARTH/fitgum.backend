<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12/21/18
 * Time: 8:58 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainersController extends Controller
{
    public function index()
    {
        $items = Trainer::where('status', true)->paginate(30);

        return response()
            ->json($items);
    }

    public function show(Request $request, $slug)
    {
        $item = Trainer::with('club')
            ->where('status', true)
            ->where('slug', $slug)
            ->first();

        if (!$item) {
            return response()
                ->json([ 'error'=> 404, 'message'=> 'Not found'], 404);
        }

        $item->views += 1;
        $item->save();

        return response()
            ->json($item->toArray());
    }
}
