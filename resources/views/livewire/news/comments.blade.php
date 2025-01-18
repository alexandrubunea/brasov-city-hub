<div class="mt-3 bg-indigo-600 p-5 rounded-lg text-zinc-200 my-10 mx-auto w-[95%]">
    <h1 id="comments" class="text-2xl uppercase font-bold"><i class="fa-solid fa-comment-dots"></i> Comments...</h1>
    <form class="my-5" wire:submit.prevent="addComment">
        <div x-data="{ text: '', borderColor: 'border-transparent', focusColor: 'focus:border-transparent', textColor: 'text-zinc-200' }">
            <textarea x-model="text"
                @input="
                    borderColor = text.length > 500 ? 'border-red-500' : 'border-transparent'
                    focusColor = text.length > 500 ? 'focus:border-red-500' : 'focus:border-transparent';
                    textColor = text.length > 500 ? 'text-red-500' : 'text-zinc-200';"
                :class="`${borderColor} ${focusColor}`"
                class="block rounded-md focus:ring-0 focus:outline-0 focus:shadow-none text-zinc-200 bg-indigo-700 resize-none w-full placeholder-zinc-400"
                placeholder="Write your thoughts about this article..." 
                wire:model="content" rows="3"></textarea>
            <div class="flex flex-col justify-end">
                <span :class="textColor" class="text-sm text-right font-medium">Characters used: <span
                        x-text="text.length"></span>/500</span>
            </div>
        </div>
        <button type="submit"
            class="mt-3 rounded-md p-3 uppercase font-bold bg-indigo-900 hover:bg-indigo-950 transition-colors duration-500"><i
                class="fa-solid fa-square-plus"></i> Add Comment</button>
    </form>
    <hr class="my-5">
    <div class="flex flex-col gap-3">
        @forelse ($comments as $comment)
            <livewire:News.Comment :wire:key="'comment-'.$comment['id']" :comment="$comment" />
        @empty
            <h1 class="uppercase font-bold text-zinc-400 text-xl my-5">There are no comments on this article...</h1>
        @endforelse
    </div>
    @if ($number_of_pages)
        <div
            class="flex flex-row justify-center mt-5 rounded-lg p-2 lg:p-5 bg-indigo-950 gap-5 text-xs lg:text-lg overflow-x-scroll">
            @if ($current_page - 1 > 1)
                <button type="button" wire:click="firstPage"
                    class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-500 py-2 lg:py-5 rounded min-w-[30px] lg:min-w-[80px] max-w-[200px] overflow-hidden">1</button>
                @if ($current_page - 2 > 1)
                    <span class="bg-indigo-700 py-2 lg:py-5 min-w-[30px] lg:min-w-[80px] text-center rounded">...</span>
                @endif
            @endif

            @if ($current_page - 1 >= 1)
                <button type="button" wire:click="prevPage"
                    class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-500 py-2 lg:py-5 rounded min-w-[30px] lg:min-w-[80px] max-w-[200px] overflow-hidden">{{ $current_page - 1 }}</button>
            @endif

            <span
                class="bg-indigo-900 py-2 lg:py-5 min-w-[30px] lg:min-w-[80px] text-center rounded">{{ $current_page }}</span>

            @if ($current_page + 1 <= $number_of_pages)
                <button type="button" wire:click="nextPage"
                    class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-500 py-2 lg:py-5 rounded min-w-[30px] lg:min-w-[80px] max-w-[200px] overflow-hidden">
                    {{ $current_page + 1 }}</button>
            @endif

            @if ($current_page + 1 < $number_of_pages)
                @if ($current_page + 2 < $number_of_pages)
                    <span class="bg-indigo-700 py-2 lg:py-5 min-w-[30px] lg:min-w-[80px] text-center rounded">...</span>
                @endif
                <button type="button" wire:click="lastPage"
                    class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-500 py-2 lg:py-5 rounded min-w-[30px] lg:min-w-[80px] max-w-[200px] overflow-hidden">{{ $number_of_pages }}</button>
            @endif
        </div>
    @endif
</div>
