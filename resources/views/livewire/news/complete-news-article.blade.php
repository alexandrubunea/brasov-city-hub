<div class="mt-5 bg-indigo-500 p-5 rounded-lg text-zinc-200 my-10 mx-auto w-[95%]">
    <h1 class="text-2xl font-bold">{{ $title }}</h1>
    <p class="text-sm font-light"><i class="fa-solid fa-user"></i> Created by {{ $author }}</p>
    <p class="text-sm font-light"><i class="fa-solid fa-calendar-days"></i> Created on {{ $created_at }}
    </p>
    <p class="text-md font-light"><i class="fa-solid fa-calendar-plus"></i> Last update on
        {{ $updated_at }}</p>
    <p class="text-sm font-light"><i class="fa-solid fa-heart"></i> {{ $likes }} Likes</p>
    <p class="text-sm font-light"><i class="fa-solid fa-comment-dots"></i> {{ $comments }} Comments</p>
    <hr class="my-5">
    @if ($can_modify)
        <div class="bg-indigo-900 p-3 rounded-md my-5">
            <h1 class="text-xl uppercase font-bold">Article tools</h1>
            <div class="flex flex-col lg:flex-row gap-2 mt-2">
                <button type="button" wire:click="deleteArticle"
                    class="uppercase font-bold rounded-lg bg-red-500 hover:bg-red-700 transition-colors duration-500 text-lg p-3"><i
                        class="fa-solid fa-trash-can"></i> Delete Article</button>
                <a href="{{ route('news.edit', ['id' => $id]) }}"
                    class="text-center uppercase font-bold rounded-lg bg-violet-500 hover:bg-violet-700 transition-colors duration-500 text-lg p-3"><i
                        class="fa-solid fa-file-pen"></i> Edit Article</a>
            </div>
        </div>
    @endif
    <div class="text-md">
        {!! $content !!}
    </div>
    <div class="flex flex-row justify-between gap-5 bg-indigo-700 rounded-lg mt-5 p-5">
        <div class="flex flex-col items-center">
            @if ($liked_article == null)
                <button type="button" wire:click="clickHeartButton"><i
                        class="fa-solid fa-heart text-5xl hover:text-red-500 transition-colors duration-500"></i></button>
            @else
                <button type="button" wire:click="clickHeartButton"><i
                        class="fa-solid fa-heart-crack text-5xl hover:text-zinc-900 transition-colors duration-500"></i></button>
            @endif
            <p class="text-2xl font-bold"> {{ $likes }}</p>
        </div>
        <a href="#comments" class="flex flex-col items-center">
            <i class="fa-solid fa-comment-dots text-5xl hover:text-violet-500 transition-colors duration-500"></i>
            <p class="text-2xl font-bold"> {{ $comments }}</p>
        </a>
    </div>
    @script
        <script>
            $wire.on('articleDeleted', () => {
                setTimeout(() => {
                    window.location.href = '{{ route('news.view') }}';
                }, 3000);
            });
        </script>
    @endscript
</div>
