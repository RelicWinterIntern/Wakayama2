<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('自分の投稿一覧') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-10 sm:px-6 lg:px-8">
        <div class="my-4">
            <a href="{{ route('post.create') }}" class="btn btn-primary" role="button">
                {{ __('新しい投稿') }}
            </a>
            <a href="{{ route('myposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-dark text-decoration-none">
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
                        <p class="text-gray-800">{{ $post->updated_at }}</p>
                        @if(isset($post->img_path))
                            <img src="{{ asset($post->img_path) }}" alt="投稿画像">
                        @endif

                        <div class="mt-4 flex">
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-primary mr-2"
                                role="button">
                                {{ __('編集') }}
                            </a>
                            <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">
                                    {{ __('削除') }}
                                </button>
                            </form>
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
