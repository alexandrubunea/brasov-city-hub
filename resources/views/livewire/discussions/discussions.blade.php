<div class="w-[95%] lg:w-2/3 mx-auto mb-10">
@if ($can_create_discussion) 
    <form wire:submit.prevent="addDiscussion"
        class="p-5 rounded-lg mb-6 bg-gradient-to-br from-indigo-500 to-violet-800 text-zinc-200">
        <div x-data="{
            text: '',
            get isOverLimit() { return this.text.length > 500 },
            get remainingChars() { return 500 - this.text.length }
        }">
            <div class="relative mb-2">
                <textarea x-model="text" wire:model="content" rows="3" placeholder="What do you want to do in the city today?"
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
                    <label for="sport-event" class="ms-2 text-sm font-medium"><i class="fa-solid fa-bicycle"></i> Sport
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
                    <label for="show" class="ms-2 text-sm font-medium"><i class="fa-solid fa-star"></i> Show</label>
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
                    <label for="other" class="ms-2 text-sm font-medium"><i class="fa-solid fa-boxes-stacked"></i>
                        Other</label>
                </div>
            </div>

            <button type="submit"
                class="flex items-center gap-2 px-4 py-3 bg-indigo-900 rounded-lg font-bold uppercase
                       transition duration-200 hover:bg-indigo-950 transform hover:scale-105
                       focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50"
                :disabled="isOverLimit" :class="isOverLimit ? 'opacity-50 cursor-not-allowed' : ''">
                <i class="fa-solid fa-square-plus"></i>
                <span>Create Discussion</span>
            </button>
        </div>
    </form>
@endif
    <div class="p-5 rounded-lg bg-gradient-to-br from-indigo-700 to-violet-900 text-zinc-200">
        <h1 class="uppercase font-bold text-3xl mt-10"><i class="fa-solid fa-compass"></i> Explore Discussions</h1>
        <div class="px-5 mt-3 flex flex-col lg:flex-row gap-5">
            <h1 wire:click="setOrderBy('hotness')"
                class="@if ($sort_by != 'hotness') text-zinc-400 @endif uppercase font-bold text-xl border-b border-b-indigo-500 pb-3 lg:pb-0 lg:border-b-0 lg:border-r lg:border-indigo-500 lg:pr-5 hover:cursor-pointer">
                <i class="fa-solid fa-fire"></i> Hottest
            </h1>
            <h1 wire:click="setOrderBy('latest')"
                class="@if ($sort_by != 'latest') text-zinc-400 @endif uppercase font-bold text-xl border-b border-b-indigo-500 pb-3 lg:pb-0 lg:border-b-0 lg:border-r lg:border-indigo-500 lg:pr-5 hover:cursor-pointer">
                <i class="fa-solid fa-clock-rotate-left"></i> Latest
            </h1>
            <h1 wire:click="setOrderBy('most_liked')"
                class="@if ($sort_by != 'most_liked') text-zinc-400 @endif uppercase font-bold text-xl hover:cursor-pointer">
                <i class="fa-solid fa-heart"></i> Most Liked
            </h1>
        </div>
        <hr class="my-5 border-indigo-500">
        <div class="flex flex-col gap-5">
            @foreach ($discussions as $index => $discussion)
                <livewire:Discussions.Discussion :wire:key="'id-'.$discussion['id'].'-'.$index" :discussion="$discussion" />
            @endforeach

            @if (sizeof($discussions) == 0)
                <h1 class="text-zinc-400/80 uppercase text-xl font-bold text-center">There are no discussions</h1>
            @else
                <h1 class="text-zinc-400/80 uppercase text-xl font-bold text-center">You've reached the end</h1>
            @endif
        </div>
    </div>
    @script
        <script>
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $wire.dispatchSelf('loadMoreDiscussions');
                        observer.disconnect();
                    }
                });
            }, {
                threshold: 0.1
            });

            $wire.on('disconnectObserver', (event) => {
                const { lastLoadedId } = event;
                const old_load_anchor = document.getElementById(`discussion-${lastLoadedId}`);
                observer.disconnect(old_load_anchor);
            });

            $wire.on('discussionsLoaded', (event) => {
                const { lastLoadedId, hasMoreDiscussions } = event;

                if (!hasMoreDiscussions) return;

                setTimeout(() => {
                    const load_anchor = document.getElementById(`discussion-${lastLoadedId}`);
                    if (load_anchor)
                        observer.observe(load_anchor);
                }, 100);
            });
        </script>
    @endscript
</div>
