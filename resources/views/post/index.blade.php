<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿一覧') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
        <div class="my-4">
            <a href="{{ route('post.create') }}" class="btn btn-primary" role="button">
                {{ __('新しい投稿') }}
            </a>

            <a href="{{ route('myposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
                {{ __('自分の投稿を確認する') }}
            </a>
            <a href="{{ route('post.index') }}" class="inline-block ml-4 py-2 px-4 btn btn-dark text-decoration-none">
                {{ __('全投稿') }}
            </a>
            <a href="{{ route('freeposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
                {{ __('フリー') }}
            </a>
            <a href="{{ route('sportsposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
                {{ __('スポーツ') }}
            </a>
            <a href="{{ route('animeposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
                {{ __('アニメ') }}
            </a>
            <a href="{{ route('gameposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
                {{ __('ゲーム') }}
            </a>
            <a href="{{ route('movieposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
                {{ __('動画') }}
            </a>
            <a href="{{ route('likeSort') }}" class="inline-block ml-4 py-2 px-4 btn {{ request()->is('likeSort') ? 'btn-dark' : 'btn-secondary' }} text-decoration-none">
                {{ __('人気のある投稿順') }}
            </a>
        </div>

        <div class="my-4">
            @if (!empty($posts))
                <ul>
                    @foreach ($posts as $post)
                        <li class="mb-6 bg-white border rounded-lg p-4">
                            <h2 class="text-lg font-bold mb-2 border-bottom">{{ $post->title }}</h2>
                            <p class="text-gray-1000 mt-4">{!! nl2br($post->makeLink($post->body)) !!}</p>
                            @if(isset($post->img_path))
                                <img src="{{ asset($post->img_path) }}" alt="投稿画像">
                            @endif
                            <div class="flex justify-between mt-8">
                                <span>
                                    @if ($post->is_liked())
                                        <a href="{{ route('post.unlike', $post->id) }}" class="btn btn-success btn-sm">
                                            いいね済
                                            {{ $post->likes->count() }}
                                        </a>
                                    @else
                                        <a href="{{ route('post.like', $post->id) }}" class="btn btn-secondary btn-sm">
                                            いいね
                                            <span class="badge">{{ $post->likes->count() }}</span>
                                        </a>
                                    @endif
                                </span>
                                <p class="text-gray-600">
                                    {{ $post->user->name }} &emsp; {{ $post->updated_at }}
                                </p>
                            </div>
                            <div class="btn btn-primary btn-sm show-replies-btn" data-post-id="{{ $post->id }}">スレッドを表示 ( {{ $post->replies->count() }} 件)</div>
                            <div class="replies-section" id="replies-section-{{ $post->id }}" style="display: none;">
                                <h3>返信</h3>
                                <ul class="replies-list">
                                    @foreach($post->replies as $reply)
                                        <li>{{ $reply->reply_content }}</li>
                                    @endforeach
                                </ul>
                                <form method="post" class="reply-form" action="{{ route('post.store') }}" enctype="multipart/form-data">
                                    <textarea name="reply_content" id="reply_content" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="この投稿にどう感じた？" required></textarea>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2">画像のアップロード</label>
                                        <input type="file" name="image">
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="py-2 px-4 btn btn-primary reply-btn" data-post-id="{{ $post->id }}">投稿する</button>
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="flex justify-center items-center h-full">
                    <p class="text-lg text-gray-600">投稿はありません。</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.show-replies-btn').click(function () {
            var postId = $(this).data('post-id');
            var repliesSection = $('#replies-section-' + postId);
            $(this).hide();
            // 返信一覧とフォームを表示・非表示切り替え
            repliesSection.slideToggle();
        });

        $('.reply-btn').click(function () {
            var postId = $(this).data('post-id');
            var repliesSection = $('#replies-section-' + postId);
            console.log("t")
            // 返信一覧とフォームを表示・非表示切り替え
            repliesSection.hide();
            $('.show-replies-btn').show();
        });
    });
</script>
