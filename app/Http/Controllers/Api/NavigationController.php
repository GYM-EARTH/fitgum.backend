<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12/21/18
 * Time: 8:58 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Navigation;

class NavigationController extends Controller
{
    public function index()
    {
        $items = Navigation::all();

        return response()
            ->json($items);
    }
}
