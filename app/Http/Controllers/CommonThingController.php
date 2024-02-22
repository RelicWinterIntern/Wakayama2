<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\CommonThing;
class CommonThingController extends Controller
{
    public function common($post_id)
    {
        $like = new CommonThing;
        $like->user_id = Auth::user()->id;
        $like->post_id = $post_id;
        $like->save();
        return redirect()->back();
    }

    public function uncommon($post_id)
    {
        // 現在のユーザIDを取得
        $user_id = Auth::user()->id;

        // 特定の投稿とユーザーに関連するLikeモデルを検索
        $like = CommonThing::where('post_id', $post_id)->where('user_id', $user_id)->first();
        // Likeモデルが見つかった場合、削除
        if ($like) {
            $like->delete();
        }
        // 呼び出し元ページにリダイレクト
        return redirect()->back();
    }
}

