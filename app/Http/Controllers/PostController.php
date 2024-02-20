<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'topic_tag' => 'required|string',

        ]);

        $post = new Post();
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->topic_tag = $validatedData['topic_tag'];
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('post.index')->with('success', '投稿が作成されました');
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
        return view('my-posts', compact('posts'));
    }
    
    public function freePosts()
    {
        $posts = Post::where('topic_tag', 'フリー')->orderBy('updated_at', 'desc')->get();
        return view('free-posts', compact('posts'));
    }

    public function sportsPosts()
    {
        $posts = Post::where('topic_tag', 'スポーツ')->orderBy('updated_at', 'desc')->get();
        return view('sports-posts', compact('posts'));
    }
    public function animePosts()
    {
        $posts = Post::where('topic_tag', 'アニメ')->orderBy('updated_at', 'desc')->get();
        return view('anime-posts', compact('posts'));
    }

    public function gamePosts()
    {
        $posts = Post::where('topic_tag', 'ゲーム')->orderBy('updated_at', 'desc')->get();
        return view('game-posts', compact('posts'));
    }

    public function moviePosts()
    {
        $posts = Post::where('topic_tag', '動画')->orderBy('updated_at', 'desc')->get();
        return view('movie-posts', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'topic_tag' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->topic_tag = $validatedData['topic_tag'];
        $post->save();

        return redirect()->route('myposts')->with('success', '投稿が更新されました');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('myposts')->with('success', '投稿が削除されました');
    }
}

