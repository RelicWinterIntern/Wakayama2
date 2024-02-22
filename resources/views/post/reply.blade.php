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
<div class="replies-section" id="replies-section-{{ $post->id }}" style="display: none;">
  <h3>返信</h3>
  <ul class="replies-list">
      @foreach($post->replies as $reply)
          <li>{{ $reply->reply_content }}</li>
      @endforeach
  </ul>
  <form method="post" class="reply-form" action="{{ route('reply.store', $post->id) }}" enctype="multipart/form-data">
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