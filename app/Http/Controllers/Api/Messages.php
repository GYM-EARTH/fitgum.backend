<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 3/19/19
 * Time: 9:48 AM
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;

class Messages
{
    public function store(Request $request)
    {
        dd($request->all());
    }

    public function get(Request $request)
    {
        dd($request->all());
    }
}
