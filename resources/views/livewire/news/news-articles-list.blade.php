<div class="w-[95%] lg:w-2/3 mx-auto text-zinc-200 mb-10">
    <div class="bg-gradient-to-br from-indigo-700 to-violet-700 p-4 lg:p-6 rounded-lg shadow-inner mb-6">
        <h1 class="text-3xl font-bold flex items-center gap-2 mb-4">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span>Search an article</span>
        </h1>

        <form wire:submit.prevent="submitSearch" class="space-y-4">
            <div>
                <label class="block font-semibold mb-2" for="search_bar">Search an article by its name:</label>
                <input
                    class="w-full text-zinc-900 bg-zinc-100 rounded-lg border-2 border-transparent p-3 transition duration-200 focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    wire:model="search_bar" id="search_bar" type="search" placeholder="Name of the article...">
            </div>

            <div x-data="{ open: false, selected: '<i class=\'fa-solid fa-fire\'></i> Hotness' }" class="relative">
                <input type="hidden" wire:model="sort">
                <label class="block font-semibold mb-2" for="sort_by">Sort the results by:</label>
                <button @click.prevent="open = !open" id="sort_by"
                    class="w-full text-left bg-zinc-100 text-zinc-900 rounded-lg p-3 flex items-center justify-between border-2 border-transparent hover:border-indigo-400 transition duration-200">
                    <span x-html="selected"></span>
                    <i class="fas fa-chevron-down transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>

                <ul x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="absolute z-10 w-full mt-2 bg-zinc-100 text-zinc-900 rounded-lg shadow-lg border border-zinc-200">
                    <li @click="selected = '<i class=\'fa-solid fa-fire\'></i> Hotness'; $wire.sort = 'hot'; open = false"
                        class="p-3 hover:bg-zinc-200 cursor-pointer flex items-center gap-2 transition duration-200">
                        <i class="fa-solid fa-fire"></i>
                        <span>Hotness</span>
                    </li>
                    <li @click="selected = '<i class=\'fa-solid fa-heart\'></i> Most Liked'; $wire.sort = 'likes'; open = false"
                        class="p-3 hover:bg-zinc-200 cursor-pointer flex items-center gap-2 transition duration-200">
                        <i class="fa-solid fa-heart"></i>
                        <span>Most Liked</span>
                    </li>
                    <li @click="selected = '<i class=\'fa-solid fa-clock-rotate-left\'></i> Most Recent'; $wire.sort = 'recent'; open = false"
                        class="p-3 hover:bg-zinc-200 cursor-pointer flex items-center gap-2 transition duration-200">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <span>Most Recent</span>
                    </li>
                </ul>
            </div>

            <div x-data="{ open: false, selected: '<i class=\'fa-solid fa-arrow-down-wide-short\'></i> Descending' }" class="relative">
                <input type="hidden" wire:model="order">
                <label class="block font-semibold mb-2" for="order_by">Order the results by:</label>
                <button @click.prevent="open = !open" id="order_by"
                    class="w-full text-left bg-zinc-100 text-zinc-900 rounded-lg p-3 flex items-center justify-between border-2 border-transparent hover:border-indigo-400 transition duration-200">
                    <span x-html="selected"></span>
                    <i class="fas fa-chevron-down transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>

                <ul x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="absolute z-10 w-full mt-2 bg-zinc-100 text-zinc-900 rounded-lg shadow-lg border border-zinc-200">
                    <li @click="selected = '<i class=\'fa-solid fa-arrow-down-wide-short\'></i> Descending'; $wire.order = 'desc'; open = false"
                        class="p-3 hover:bg-zinc-200 cursor-pointer flex items-center gap-2 transition duration-200">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>
                        <span>Descending</span>
                    </li>
                    <li @click="selected = '<i class=\'fa-solid fa-arrow-down-short-wide\'></i> Ascending'; $wire.order = 'asc'; open = false"
                        class="p-3 hover:bg-zinc-200 cursor-pointer flex items-center gap-2 transition duration-200">
                        <i class="fa-solid fa-arrow-down-short-wide"></i>
                        <span>Ascending</span>
                    </li>
                </ul>
            </div>

            <button type="submit"
                class="w-full sm:w-auto px-6 py-3 bg-indigo-400 hover:bg-indigo-900 active:bg-indigo-900 rounded-lg font-bold uppercase transition duration-200 transform hover:scale-105">
                Search
            </button>
        </form>
    </div>

    @if ($is_news_creator)
        <div class="bg-gradient-to-br from-indigo-900 to-violet-900 p-4 lg:p-6 rounded-lg shadow-inner mb-6">
            <p class="text-base lg:text-lg mb-4">
                One of your roles grants you the ability to create news content. Please press the button below if you
                wish
                to proceed.
            </p>
            <a href="{{ route('news.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-400 hover:bg-indigo-600 px-6 py-3 rounded-lg font-bold transition duration-200 transform hover:scale-105">
                <i class="fa-regular fa-square-plus"></i>
                <span>Create News Article</span>
            </a>
        </div>
    @endif

    <div class="bg-gradient-to-br from-indigo-900 to-violet-900 p-4 lg:p-6 rounded-lg shadow-inner">
        <div class="space-y-4">
            @forelse ($news_articles as $news_article)
                <livewire:News.NewsArticle :wire:key="'news-article-'.$news_article['id']" :news_article="$news_article" />
            @empty
                <div class="text-center py-8">
                    <h2 class="text-xl font-bold text-zinc-500 uppercase">No news articles found.</h2>
                </div>
            @endforelse
        </div>
        @if ($number_of_pages)
            <div class="mt-6 bg-zinc-900/80 rounded-lg p-4 overflow-x-auto">
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
</div>
