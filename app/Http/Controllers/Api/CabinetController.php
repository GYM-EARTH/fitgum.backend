<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 4/9/19
 * Time: 11:18 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\UpdateAvatar;
use Illuminate\Support\Facades\Auth;
use Image;

class CabinetController extends Controller
{
    public function index()
    {
        return request()->user();
    }

    public function updateAvatar(UpdateAvatar $request)
    {
        $user = Auth::user();

        if (file_exists($user->avatar)) {
            unlink($user->avatar);
        }

        if (null !== $request->file('image')) {
            $fileName = substr(sha1($request->file('image')->getBasename() . uniqid()), 1, 5) . '.' . $request->file('image')->extension();
            $path = \Storage::disk('public')->path('users/avatars') . '/' . $fileName;
            Image::make($request->file(('image')))->fit(512, 512)->save($path);
            $user->avatar = \Storage::disk('public')->url('/files/users/avatars/' . $fileName);
            try {
                $user->saveOrFail();
            } catch (\Throwable $exception) {
                return response()->json(['error' => 'Error updating avatar'], 500);
            }
        }
    }
}
