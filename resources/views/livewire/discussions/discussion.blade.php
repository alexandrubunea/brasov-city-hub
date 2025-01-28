<div id="discussion-{{ $discussion['id'] }}" class="bg-indigo-500 p-5 rounded-md w-full">
    <div class="flex flex-row justify-between">
        <h1 class="font-bold text-xl uppercase">{{ $discussion['author'] }}</h1>
        <div class="flex flex-row items-center gap-8">
            <span class="text-light text-sm flex flex-row gap-3 items-center"><span class="uppercase"><i
                        class="fa-solid fa-clock"></i>
                    {{ $discussion['created_at'] }}</span>

                @if ($is_edited)
                    <span class="text-xs">● Edited</span>
                @endif

            </span>
            @if ($can_edit_discussion || $can_delete_discussion)
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="text-xl">
                        <i class="fas fa-ellipsis"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition transform ease-out duration-200"
                        x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100"
                        x-transition:leave="transition transform ease-in duration-150"
                        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0"
                        @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-indigo-900/70 rounded-lg shadow-xl z-10">
                        <ul class="py-1">
                            @if ($can_edit_discussion)
                                <li>
                                    <button wire:click="editDiscussion"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-indigo-600 transition duration-200 flex items-center gap-2">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Edit</span>
                                    </button>
                                </li>
                            @endif
                            @if ($can_delete_discussion)
                                <li>
                                    <button wire:click="deleteDiscussion"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-indigo-600 transition duration-200 flex items-center gap-2">
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
    </div>
    @if ($edit_mode)
        <form wire:submit.prevent="saveEditDiscussion"
            class="p-5 rounded-lg my-5 text-zinc-200">
            <div x-data="{
                text: '{{ Str::of($content)->trim() }}',
                get isOverLimit() { return this.text.length > 500 },
                get remainingChars() { return 500 - this.text.length }
            }">
                <div class="relative mb-2">
                    <textarea x-model="text" wire:model="content" rows="3" placeholder="What do you want to do in the city today?"
                        class="block w-full p-4 bg-indigo-700 rounded-lg resize-none 
                           placeholder-zinc-400 transition duration-200
                           focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50
                           border-2"
                        :class="isOverLimit ? 'border-red-500 focus:border-red-500' :
                            'border-transparent focus:border-indigo-400'"></textarea>
                </div>

                <div class="flex justify-end mb-3">
                    <span class="text-sm font-medium transition-colors duration-200"
                        :class="isOverLimit ? 'text-red-400' : 'text-zinc-300'">
                        Characters: <span x-text="text.length"></span>/500
                    </span>
                </div>

                <p class="uppercase font-bold text-lg mb-5 lg:mb-2">Activity Type:</p>
                <div class="flex flex-col lg:flex-row gap-5 lg:gap-10 mb-10">
                    <div class="flex items-center">
                        <input id="cultural-event" type="checkbox" value="false" wire:model="cultural_event"
                            class="w-4 h-4 text-indigo-950 bg-indigo-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                        <label for="cultural-event" class="ms-2 text-sm font-medium"><i
                                class="fa-solid fa-masks-theater"></i> Cultural Event</label>
                    </div>
                    <div class="flex items-center">
                        <input id="sport-event" type="checkbox" value="false" wire:model="sport_event"
                            class="w-4 h-4 text-indigo-950 bg-indigo-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                        <label for="sport-event" class="ms-2 text-sm font-medium"><i class="fa-solid fa-bicycle"></i>
                            Sport
                            Event</label>
                    </div>
                    <div class="flex items-center">
                        <input id="movie-night" type="checkbox" value="false" wire:model="movie_night"
                            class="w-4 h-4 text-indigo-950 bg-indigo-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                        <label for="movie-night" class="ms-2 text-sm font-medium"><i class="fa-solid fa-film"></i> Movie
                            Night</label>
                    </div>
                    <div class="flex items-center">
                        <input id="party" type="checkbox" value="false" wire:model="party"
                            class="w-4 h-4 text-indigo-950 bg-indigo-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                        <label for="party" class="ms-2 text-sm font-medium"><i class="fa-solid fa-icons"></i>
                            Party</label>
                    </div>
                    <div class="flex items-center">
                        <input id="show" type="checkbox" value="false" wire:model="show"
                            class="w-4 h-4 text-indigo-950 bg-indigo-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                        <label for="show" class="ms-2 text-sm font-medium"><i class="fa-solid fa-star"></i>
                            Show</label>
                    </div>
                    <div class="flex items-center">
                        <input id="concert" type="checkbox" value="false" wire:model="concert"
                            class="w-4 h-4 text-indigo-950 bg-indigo-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                        <label for="concert" class="ms-2 text-sm font-medium"><i class="fa-solid fa-guitar"></i>
                            Concert</label>
                    </div>
                    <div class="flex items-center">
                        <input id="other" type="checkbox" value="false" wire:model="other"
                            class="w-4 h-4 text-indigo-950 bg-indigo-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                        <label for="other" class="ms-2 text-sm font-medium"><i
                                class="fa-solid fa-boxes-stacked"></i>
                            Other</label>
                    </div>
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
                    <button type="button" wire:click="cancelEditDiscussion"
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
        <div class="flex flex-row flex-wrap gap-2 mt-2">
            @if ($cultural_event)
                <span class="bg-red-500 text-xs p-2 rounded-md"><i class="fa-solid fa-masks-theater"></i> Cultural
                    Event</span>
            @endif
            @if ($sport_event)
                <span class="bg-sky-500 text-xs p-2 rounded-md"><i class="fa-solid fa-bicycle"></i> Sport Event</span>
            @endif
            @if ($movie_night)
                <span class="bg-emerald-500 text-xs p-2 rounded-md"><i class="fa-solid fa-film"></i> Movie
                    Night</span>
            @endif
            @if ($party)
                <span class="bg-teal-500 text-xs p-2 rounded-md"><i class="fa-solid fa-icons"></i> Party</span>
            @endif
            @if ($show)
                <span class="bg-yellow-500 text-xs p-2 rounded-md"><i class="fa-solid fa-star"></i> Show</span>
            @endif
            @if ($concert)
                <span class="bg-orange-500 text-xs p-2 rounded-md"><i class="fa-solid fa-guitar"></i> Concert</span>
            @endif
            @if ($other)
                <span class="bg-lime-500 text-xs p-2 rounded-md"><i class="fa-solid fa-boxes-stacked"></i>
                    Other</span>
            @endif
        </div>
        <p class="text-justify mt-5">
            {{ $content }}
        </p>
        <div class="mt-5 flex flex-row items-center gap-3">
            @if ($liked_discussion == null)
                <i wire:click="clickHeartButton"
                    class="fa-solid fa-heart text-4xl hover:text-red-500 hover:scale-125 transition-all duration-500 hover:cursor-pointer"></i>
            @else
                <i wire:click="clickHeartButton"
                    class="fa-solid fa-heart-crack text-4xl hover:text-zinc-900 hover:scale-125 transition-all duration-500 hover:cursor-pointer"></i>
            @endif
            <span class="text-xl font-bold">{{ $discussion['likes'] }}</span>
        </div>
    @endif
</div>
