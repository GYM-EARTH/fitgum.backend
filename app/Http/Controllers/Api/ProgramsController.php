<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 4/20/19
 * Time: 5:23 PM
 */

namespace App\Http\Controllers\Api;


use App\Models\Program;
use Request;

class ProgramsController
{
    public function index()
    {
        $items = Program::where('status', true)->paginate(30);

        return response()
            ->json($items);
    }

    public function show(Request $request, $slug)
    {
        $item = Program::with('programDays')
            ->with('programDays.schedules')
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
