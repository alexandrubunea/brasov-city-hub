<div class="bg-indigo-500 p-5 rounded-lg text-zinc-200 w-full">
    <h1 class="font-bold text-2xl"><i class="fa-solid fa-newspaper mr-5"></i>The compilation of news available on our
        website</h1>
    <hr class="my-3">
    <div class="bg-indigo-700 p-3 rounded-md">
        <h2 class="font-bold text-xl"><i class="fa-solid fa-magnifying-glass"></i> Search an article</h2>
        <form wire:submit.prevent="submitSearch" class="p-6 w-full rounded-md">
            <label class="block font-semibold mb-2" for="search_bar">Search an article by its name:</label>
            <input
                class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                wire:model="search_bar" id="search_bar" name="search_bar" type="search_bar" placeholder="Name of the article...">


            <div x-data="{ open: false, selected: '<i class=\'fa-solid fa-fire\'></i> Hotness' }" class="relative w-full mt-5">
                <input type="hidden" wire:model="sort">
                <label class="block font-semibold mb-2" for="sort_by">Sort the results by:</label>
                <button @click.prevent="open = !open" id="sort_by"
                    class="w-full text-left bg-zinc-100 border border-gray-300 rounded-lg p-3 flex items-center justify-between text-zinc-900">
                    <span x-html="selected"></span>
                    <i class="fas fa-chevron-down"></i>
                </button>

                <ul x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="absolute z-10 w-full bg-zinc-100 border border-gray-300 text-zinc-900 rounded-lg mt-2">
                    <li @click="selected = '<i class=\'fa-solid fa-fire\'></i> Hotness'; $wire.sort = 'hot'; open = false"
                        class="px-4 py-2 hover:bg-zinc-300 rounded-lg cursor-pointer flex items-center space-x-2">
                        <i class="fa-solid fa-fire"></i><span>Hotness</span>
                    </li>
                    <li @click="selected = '<i class=\'fa-solid fa-heart\'></i> Most Liked'; $wire.sort = 'likes'; open = false"
                        class="px-4 py-2 hover:bg-zinc-300 rounded-lg cursor-pointer flex items-center space-x-2">
                        <i class="fa-solid fa-heart"></i><span>Most Liked</span>
                    </li>
                    <li @click="selected = '<i class=\'fa-solid fa-clock-rotate-left\'></i> Most Recent'; $wire.sort = 'recent'; open = false"
                        class="px-4 py-2 hover:bg-zinc-300 rounded-lg cursor-pointer flex items-center space-x-2">
                        <i class="fa-solid fa-clock-rotate-left"></i><span>Most Recent</span>
                    </li>
                </ul>
            </div>

            <div x-data="{ open: false, selected: '<i class=\'fa-solid fa-arrow-down-wide-short\'></i> Descending' }" class="relative w-full mt-5">
                <input type="hidden" wire:model="order">
                <label class="block font-semibold mb-2" for="order_by">Order the results by:</label>
                <button @click.prevent="open = !open" id="order_by"
                    class="w-full text-left bg-zinc-100 border border-gray-300 rounded-lg p-3 flex items-center justify-between text-zinc-900">
                    <span x-html="selected"></span>
                    <i class="fas fa-chevron-down"></i>
                </button>

                <ul x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="absolute w-full bg-zinc-100 border border-gray-300 text-zinc-900 rounded-lg mt-2">
                    <li @click="selected = '<i class=\'fa-solid fa-arrow-down-wide-short\'></i> Descending'; $wire.order = 'desc'; open = false"
                        class="px-4 py-2 hover:bg-zinc-300 rounded-lg cursor-pointer flex items-center space-x-2">
                        <i class="fa-solid fa-arrow-down-wide-short"></i><span> Descending</span>
                    </li>
                    <li @click="selected = '<i class=\'fa-solid fa-arrow-down-short-wide\'></i> Ascending'; $wire.order = 'asc'; open = false"
                        class="px-4 py-2 hover:bg-zinc-300 rounded-lg cursor-pointer flex items-center space-x-2">
                        <i class="fa-solid fa-arrow-down-short-wide"></i><span> Ascending</span>
                    </li>
                </ul>
            </div>
            <button type="submit"
                class="mt-5 bg-indigo-400 p-3 hover:bg-indigo-900 transition-colors duration-500 rounded-md font-bold uppercase">Search</button>
        </form>
    </div>

    @if ($is_news_creator)
        <div class="bg-indigo-900 p-3 mt-3 rounded-md flex flex-col gap-5">
            <p class="text-md font-light">One of your roles grants you the ability to create news content. Please press
                the
                button below if you wish to proceed.</p>
            <a href="{{ route('news.create') }}"
                class="bg-indigo-400 hover:bg-indigo-600 transition-colors duration-500 p-5 rounded-lg max-w-64 font-bold text-center"><i
                    class="fa-regular fa-square-plus"></i> Create News Article</a>
        </div>
    @endif

    <div class="bg-indigo-900 p-3 mt-3 rounded-md flex flex-col items-center gap-5">
        @forelse ($news_articles as $news_article)
            <livewire:News.NewsArticle :wire:key="'news-article-'.$news_article['id']" :id="$news_article['id']"
                :title="$news_article['title']" :content="$news_article['content']" :author="$news_article['user_name']" :likes="$news_article['likes_count']" :created_on="$news_article['created_at']"
                :updated_on="$news_article['updated_at']" />
        @empty
            <h1 class="my-5 text-xl font-bold text-zinc-500 uppercase">No news articles found.</h1>
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
