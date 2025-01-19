<div class="w-[95%] lg:w-2/3 mt-5 bg-gradient-to-br from-indigo-500 to-violet-500 p-5 rounded-lg text-zinc-200 my-10 mx-auto">
    <div class="space-y-2">
        <h1 class="text-2xl lg:text-3xl font-bold leading-tight">{{ $title }}</h1>
        <div class="flex flex-wrap gap-4 text-sm lg:text-base opacity-90">
            <p class="flex items-center gap-2">
                <i class="fa-solid fa-user"></i>
                <span>{{ $author }}</span>
            </p>
            <p class="flex items-center gap-2">
                <i class="fa-solid fa-calendar-days"></i>
                <span>{{ $created_at }}</span>
            </p>
            <p class="flex items-center gap-2">
                <i class="fa-solid fa-calendar-plus"></i>
                <span>{{ $updated_at }}</span>
            </p>
        </div>
    </div>

    @if ($can_modify)
        <div class="bg-zinc-900/50 p-3 rounded-md my-5">
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
    <hr class="my-5">
    <div class="text-md">
        {!! $content !!}
    </div>
    <div class="flex flex-row justify-between gap-5 bg-zinc-900/50 rounded-lg mt-5 p-5">
        <div class="flex flex-col items-center">
            @if ($liked_article == null)
                <i wire:click="clickHeartButton"
                    class="fa-solid fa-heart text-5xl hover:text-red-500 hover:scale-125 transition-all duration-500 hover:cursor-pointer"></i>
            @else
                <i wire:click="clickHeartButton"
                    class="fa-solid fa-heart-crack text-5xl hover:text-zinc-900 hover:scale-125 transition-all duration-500 hover:cursor-pointer"></i>
            @endif
            <p class="text-2xl font-bold"> {{ $likes }}</p>
        </div>
        <div class="flex flex-col items-center">
            <a href="#comments" class="flex flex-col items-center">
                <i class="fa-solid fa-comment-dots text-5xl hover:text-violet-500 hover:scale-125 transition-all duration-500"></i>
            </a>
            <p class="text-2xl font-bold"> {{ $comments }}</p>
        </div>
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
