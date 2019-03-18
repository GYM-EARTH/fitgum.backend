<?php

namespace App\Http\Controllers;

use App\Events\TestMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function chat()
    {
        $message = 'some text';
        broadcast(new TestMessage($message));
        return $message;
    }
}
