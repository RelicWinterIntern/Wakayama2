<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('スポーツに関する投稿一覧') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-10 sm:px-6 lg:px-8">
        <div class="my-4">
            <a href="{{ route('post.create') }}" class="btn btn-primary" role="button">
                {{ __('新しい投稿') }}
            </a>
            <a href="{{ route('myposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
                {{ __('自分の投稿を確認する') }}
            </a>
            <a href="{{ route('post.index') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
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
        </div>


        @if (!empty($posts))
            <div class="grid grid-cols-1 gap-4">
                @foreach ($posts as $post)
                    <div class="bg-white shadow p-6 rounded-lg">
                    <h2 class="text-lg font-bold mb-2 border-bottom">{{ $post->title }}</h2>
                        <p class="text-gray-1000 mt-4">{!! nl2br($post->makeLink($post->body)) !!}</p>
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
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex justify-center items-center h-full">
                <p class="text-lg text-gray-600">投稿はありません。</p>
            </div>
        @endif
    </div>
</x-app-layout>
