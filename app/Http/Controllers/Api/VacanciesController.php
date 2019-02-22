<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12/21/18
 * Time: 8:58 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacanciesController extends Controller
{
    public function index()
    {
        $items = Vacancy::paginate(30);

        return response()
            ->json($items);
    }

    public function show(Request $request, $id)
    {
        $item = Vacancy::with('metro')
            ->with('club')
            ->with('city')
            ->where('id', $id)
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
