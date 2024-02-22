<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Sad;

class SadController extends Controller
{
    public function sad($post_id)
    {
        $sad = new Sad;
        $sad->user_id = Auth::user()->id;
        $sad->post_id = $post_id;
        $sad->save();
        return redirect()->back();
    }

    public function unsad($post_id)
    {
        // 現在のユーザIDを取得
        $user_id = Auth::user()->id;
        $sad = Sad::where('post_id', $post_id)->where('user_id', $user_id)->first();
        if ($sad) {
            $sad->delete();
        }
        // 呼び出し元ページにリダイレクト
        return redirect()->back();
    }
}
