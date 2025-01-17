<div class="mt-5 bg-indigo-500 p-5 rounded-lg text-zinc-200 my-10 mx-auto w-[95%]">
    <h1 class="text-2xl font-bold">{{ $title }}</h1>
    <p class="text-sm font-light"><i class="fa-solid fa-user"></i> Created by {{ $author }}</p>
    <p class="text-sm font-light"><i class="fa-solid fa-calendar-days"></i> Created on {{ $created_at }}
    </p>
    <p class="text-md font-light"><i class="fa-solid fa-calendar-plus"></i> Last update on
        {{ $updated_at }}</p>
    <p class="text-sm font-light"><i class="fa-solid fa-heart"></i> {{ $likes }} Likes</p>
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
    <hr class="my-5">
    @if ($liked_article == null)
        <button type="button" wire:click="clickHeartButton"
            class="bg-transparent text-2xl font-bold border border-zinc-200 rounded-lg p-3 hover:bg-indigo-900 transition-colors duration-500 hover:border-transparent"><i
                class="fa-regular fa-heart"></i> {{ $likes }}</button>
    @else
        <button type="button" wire:click="clickHeartButton"
            class="bg-transparent text-2xl font-bold border border-zinc-200 rounded-lg p-3 hover:bg-indigo-900 transition-colors duration-500 hover:border-transparent"><i
                class="fa-solid fa-heart-crack"></i> {{ $likes }}</button>
    @endif
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
