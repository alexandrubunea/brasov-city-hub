<div class="w-full text-zinc-200">
    <div class="flex flex-col sm:flex-row">
        <div
            class="bg-indigo-500 rounded-t-lg sm:rounded-l-lg p-4 sm:w-36 flex flex-col items-center justify-center text-center">
            <i class="fa-solid fa-user text-2xl mb-2"></i>
            <span class="font-medium truncate max-w-full">{{ $comment['author'] }}</span>
        </div>

        <div class="flex-1 bg-indigo-800 rounded-b-lg sm:rounded-b-none sm:rounded-r-lg p-4">
            <div class="flex items-center justify-end gap-3 mb-3 text-sm">
                <span class="font-light uppercase flex items-center gap-1">
                    <i class="fa-solid fa-clock"></i>
                    <span>{{ $comment['updated_at'] }}</span>
                </span>

                @if ($is_edited)
                    <span class="font-light text-zinc-400 flex items-center gap-1">
                        <span class="text-xs">●</span>
                        <span>Edited</span>
                    </span>
                @endif

                @if ($can_edit_comment || $can_delete_comment)
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="p-1 hover:bg-indigo-700 rounded-full transition duration-200">
                            <i class="fas fa-ellipsis"></i>
                        </button>

                        <div x-show="open" x-transition:enter="transition transform ease-out duration-200"
                            x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100"
                            x-transition:leave="transition transform ease-in duration-150"
                            x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-indigo-500/80 rounded-lg shadow-xl z-10">
                            <ul class="py-1">
                                @if ($can_edit_comment)
                                    <li>
                                        <button wire:click="editComment"
                                            class="w-full text-left px-4 py-2 text-sm hover:bg-indigo-600/80 transition duration-200 flex items-center gap-2">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span>Edit</span>
                                        </button>
                                    </li>
                                @endif
                                @if ($can_delete_comment)
                                    <li>
                                        <button wire:click="deleteComment"
                                            class="w-full text-left px-4 py-2 text-sm hover:bg-indigo-600/80 transition duration-200 flex items-center gap-2">
                                            <i class="fa-solid fa-trash-can"></i>
                                            <span>Delete</span>
                                        </button>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            @if ($edit_mode)
                <form wire:submit.prevent="saveEditComment" class="space-y-4">
                    <div x-data="{
                        text: '{{ Str::of($content)->trim() }}',
                        get isOverLimit() { return this.text.length > 500 },
                        get remainingChars() { return 500 - this.text.length }
                    }">
                        <div class="relative mb-2">
                            <textarea x-model="text" wire:model="content" rows="3" placeholder="Write your thoughts about this article..."
                                class="block w-full p-3 bg-indigo-700 rounded-lg resize-none 
                                       placeholder-zinc-400 transition duration-200
                                       focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50
                                       border-2"
                                :class="isOverLimit ? 'border-red-500 focus:border-red-500' :
                                    'border-transparent focus:border-indigo-400'"></textarea>
                        </div>

                        <div class="flex justify-end mb-2">
                            <span class="text-sm font-medium transition-colors duration-200"
                                :class="isOverLimit ? 'text-red-400' : 'text-zinc-300'">
                                Characters: <span x-text="text.length"></span>/500
                            </span>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2">
                            <button type="submit"
                                class="flex items-center justify-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 
                                       active:bg-emerald-700 rounded-lg font-bold uppercase transition duration-200 
                                       transform hover:scale-105"
                                :disabled="isOverLimit">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Save</span>
                            </button>
                            <button type="button" wire:click="cancelEditComment"
                                class="flex items-center justify-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 
                                       active:bg-red-700 rounded-lg font-bold uppercase transition duration-200 
                                       transform hover:scale-105">
                                <i class="fa-solid fa-circle-xmark"></i>
                                <span>Cancel</span>
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <p class="text-justify leading-relaxed">
                    {{ $content }}
                </p>
            @endif
        </div>
    </div>
</div>
