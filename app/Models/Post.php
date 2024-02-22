<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'author_name', 'img_path'];

    // Postモデルは１つのUserモデルに属する関係を定義
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Postモデルは複数のLikeモデルを持つ関係を定義
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }
    // Postモデルは複数のcommonthingモデルを持つ関係を定義
    public function common_things()
    {
        return $this->hasMany(CommonThing::class, 'post_id');
    }

    // ポストにいいねがされているかを判定するメソッド
    public function is_liked()
    {
        // 現在のユーザのIDを取得
        $id = Auth::id();
        // いいねをしたユーザのIDを格納するための配列を初期化
        $likers = array();
        // ポストに対するいいねを取得し、ユーザIDを配列に追加
        foreach($this->likes as $like) {
            array_push($likers, $like->user_id);
        }
        // 現在のユーザのIDがいいねをしたユーザーの配列に含まれているかを判定
        if (in_array($id, $likers)) {  // いいねがされている場合はtrueを返す
            return true;
        } else {  // いいねがされていない場合はfalseを返す
            return false;
        }
    }
    public function is_commonersed()
    {
        // 現在のユーザのIDを取得
        $id = Auth::id();
        $commoners = array();
        // ポストに対するあるあるを取得し、ユーザIDを配列に追加
        foreach($this->common_things as $common_thing) {
            array_push($commoners, $common_thing->user_id);
        }
        // 現在のユーザのIDがあるあるをしたユーザーの配列に含まれているかを判定
        if (in_array($id, $commoners)) {  // あるあるがされている場合はtrueを返す
            return true;
        } else {  // あるあるがされていない場合はfalseを返す
            return false;
        }
    }
    public function is_common()
    {
        $id = Auth::id();
        $commonThings = $this->common_things()->where('user_id', $id)->exists();
        return $commonThings;
    }


    // URLをアンカータグでリンク化する
    public function makeLink($comment) {
        //URL抽出の正規表現
        $pattern = '/https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
        //該当する文字列に処理
        $url = preg_replace_callback($pattern, function ($matches) {
                return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>';
            }, htmlspecialchars($comment));
        //dd($comment, $url)
        return $url;
    }
}
