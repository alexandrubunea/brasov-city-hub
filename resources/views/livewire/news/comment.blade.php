<div class="text-zinc-200 w-full">
    <div class="flex flex-row">
        <div
            class="flex flex-col bg-indigo-500 rounded-md rounded-r-none p-3 text-center justify-center w-36 min-h-20 overflow-ellipsis">
            <i class="fa-solid fa-user"></i>
            <span class="font-medium">{{ $comment['author'] }}</span>
        </div>
        <div class="flex flex-col bg-indigo-800 rounded-md rounded-l-none p-3 w-full">
            <div class="flex flex-row gap-5 justify-end items-center">
                <span class="font-light uppercase text-xs"><i class="fa-solid fa-clock"></i>
                    {{ $comment['updated_at'] }}
                </span>
                @if ($is_edited)
                    <span class="font-light text-xs">
                        ● Edited
                    </span>
                @endif
                @if ($can_edit_comment || $can_delete_comment)
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open">
                            <i class="fas fa-ellipsis"></i>
                        </button>

                        <div x-show="open" x-transition:enter="transition transform ease-out duration-200"
                            x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100"
                            x-transition:leave="transition transform ease-in duration-150"
                            x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0"
                            @click.away="open = false"
                            class="absolute py-1 right-0 mt-2 w-40 bg-indigo-500 shadow-lg rounded-md z-10 bg-opacity-80">
                            <ul>
                                @if ($can_edit_comment)
                                    <li
                                        class="hover:bg-indigo-950 hover:cursor-pointer transition-colors duration-500">
                                        <span wire:click="editComment" class="block px-4 py-2 text-sm">Edit</span>
                                    </li>
                                @endif
                                @if ($can_delete_comment)
                                    <li
                                        class="hover:bg-indigo-950 hover:cursor-pointer transition-colors duration-500">
                                        <span wire:click="deleteComment" class="block px-4 py-2 text-sm">Delete</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            @if ($edit_mode)
                <form class="my-5" wire:submit.prevent="saveEditComment">
                    <div x-data="{ text: '{{ Str::of($content)->trim() }}', borderColor: 'border-transparent', focusColor: 'focus:border-transparent', textColor: 'text-zinc-200' }">
                        <textarea x-model="text"
                            @input="
                                borderColor = text.length > 500 ? 'border-red-500' : 'border-transparent'
                                focusColor = text.length > 500 ? 'focus:border-red-500' : 'focus:border-transparent';
                                textColor = text.length > 500 ? 'text-red-500' : 'text-zinc-200';"
                            :class="`${borderColor} ${focusColor}`"
                            class="block rounded-md focus:ring-0 focus:outline-0 focus:shadow-none text-zinc-200 bg-indigo-700 resize-none w-full placeholder-zinc-400"
                            placeholder="Write your thoughts about this article..." wire:model="content" rows="3"></textarea>
                        <div class="flex flex-col justify-end">
                            <span :class="textColor" class="text-sm text-right font-medium">Characters used: <span
                                    x-text="text.length"></span>/500</span>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-2">
                        <button type="submit"
                            class="mt-3 rounded-md p-3 uppercase font-bold bg-emerald-500 hover:bg-emerald-600 transition-colors duration-500 lg:w-32"><i
                                class="fa-solid fa-floppy-disk"></i> Save</button>
                        <button type="button" wire:click="cancelEditComment"
                            class="mt-3 rounded-md p-3 uppercase font-bold bg-red-500 hover:bg-red-700 transition-colors duration-500 lg:w-32"><i
                                class="fa-solid fa-circle-xmark"></i> Cancel</button>

                    </div>
                </form>
            @else
                <p class="text-justify">
                    {{ $content }}
                </p>
            @endif
        </div>
    </div>
</div>
