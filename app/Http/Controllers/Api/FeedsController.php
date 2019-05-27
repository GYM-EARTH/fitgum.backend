<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12/21/18
 * Time: 8:58 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Http\Request;

class FeedsController extends Controller
{
    public function index()
    {
        $settings = Setting::where('key', 'feed')->first();
        if (null === $settings) {
            $settings = [
                "key" => "feed",
                "title" => "",
                "description" => "",
                "keywords" => "",
            ];
        } else {
            $settings = $settings->toArray();
        }

        $items = News::where('status', true)
            ->take(20)->get();

        return view('rss.feed', compact('items', 'settings'));
    }

    public function turbo() {
        $clubs = Club::orderBy('created_at', 'desc')
            ->where('status', true)->take(20)->get();

        return response()->view('feeds.turbo', compact('clubs'))->header('Content-Type', 'text/xml');
    }
}
