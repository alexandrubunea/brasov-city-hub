<div class="w-[95%] mx-auto bg-indigo-600 p-4 lg:p-6 rounded-xl text-zinc-200 my-6 lg:my-10 shadow-xl">
    <h1 id="comments" class="text-2xl lg:text-3xl uppercase font-bold mb-6">
        <i class="fa-solid fa-comment-dots"></i> Comments
    </h1>

    <form wire:submit.prevent="addComment" class="mb-6">
        <div x-data="{
            text: '',
            get isOverLimit() { return this.text.length > 500 },
            get remainingChars() { return 500 - this.text.length }
        }">
            <div class="relative mb-2">
                <textarea @if (!$can_add_comment) disabled @endif x-model="text" wire:model="content" rows="3" placeholder="@if ($can_add_comment) Write your thoughts about this article... @else Log in or create a new account to comment on this article! @endif"
                    class="block w-full p-4 bg-indigo-700 rounded-lg resize-none 
                           placeholder-zinc-400 transition duration-200
                           focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50
                           border-2"
                    :class="isOverLimit ? 'border-red-500 focus:border-red-500' : 'border-transparent focus:border-indigo-400'"></textarea>
            </div>

            <div class="flex justify-end mb-3">
                <span class="text-sm font-medium transition-colors duration-200"
                    :class="isOverLimit ? 'text-red-400' : 'text-zinc-300'">
                    Characters: <span x-text="text.length"></span>/500
                </span>
            </div>

            <button type="submit"
                class="flex items-center gap-2 px-4 py-3 bg-indigo-900 rounded-lg font-bold uppercase
                       transition duration-200 hover:bg-indigo-950 transform hover:scale-105
                       focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50"
                :disabled="isOverLimit" :class="isOverLimit ? 'opacity-50 cursor-not-allowed' : ''">
                <i class="fa-solid fa-square-plus"></i>
                <span>Add Comment</span>
            </button>
        </div>
    </form>

    <hr class="border-indigo-500 my-6">
    <div class="space-y-4">
        @forelse ($comments as $comment)
            <livewire:News.Comment :wire:key="'comment-'.$comment['id']" :comment="$comment" />
        @empty
            <div class="text-center py-8">
                <h3 class="text-xl font-bold text-zinc-400 uppercase">
                    There are no comments on this article...
                </h3>
            </div>
        @endforelse
    </div>
    @if ($number_of_pages)
        <div class="mt-6 bg-indigo-950 rounded-lg p-4 overflow-x-auto">
            <div class="flex justify-center items-center gap-2 min-w-max">
                @if ($current_page - 1 > 1)
                    <button type="button" wire:click="firstPage"
                        class="px-4 py-2 lg:px-6 lg:py-3 bg-indigo-700 hover:bg-indigo-800 rounded-lg transition duration-200">
                        1
                    </button>
                    @if ($current_page - 2 > 1)
                        <span class="px-4 py-2 lg:px-6 lg:py-3 bg-indigo-700 rounded-lg">...</span>
                    @endif
                @endif

                @if ($current_page - 1 >= 1)
                    <button type="button" wire:click="prevPage"
                        class="px-4 py-2 lg:px-6 lg:py-3 bg-indigo-700 hover:bg-indigo-800 rounded-lg transition duration-200">
                        {{ $current_page - 1 }}
                    </button>
                @endif

                <span class="px-4 py-2 lg:px-6 lg:py-3 bg-indigo-900 rounded-lg font-bold">
                    {{ $current_page }}
                </span>

                @if ($current_page + 1 <= $number_of_pages)
                    <button type="button" wire:click="nextPage"
                        class="px-4 py-2 lg:px-6 lg:py-3 bg-indigo-700 hover:bg-indigo-800 rounded-lg transition duration-200">
                        {{ $current_page + 1 }}
                    </button>
                @endif

                @if ($current_page + 1 < $number_of_pages)
                    @if ($current_page + 2 < $number_of_pages)
                        <span class="px-4 py-2 lg:px-6 lg:py-3 bg-indigo-700 rounded-lg">...</span>
                    @endif
                    <button type="button" wire:click="lastPage"
                        class="px-4 py-2 lg:px-6 lg:py-3 bg-indigo-700 hover:bg-indigo-800 rounded-lg transition duration-200">
                        {{ $number_of_pages }}
                    </button>
                @endif
            </div>
        </div>
    @endif

</div>
