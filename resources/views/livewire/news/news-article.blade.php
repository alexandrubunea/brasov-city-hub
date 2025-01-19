<div class="w-[95%] mx-auto">
    <a 
        href="{{ route('news.article', ['id' => $news_article['id']]) }}"
        class="block bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 p-4 lg:p-5 rounded-lg shadow-md transition-all duration-300 transform hover:scale-[1.02]"
    >
        <h2 class="text-xl lg:text-2xl font-bold text-zinc-100 mb-2">{{ $news_article['title'] }}</h2>

        <div class="flex flex-row gap-5 mb-1 text-zinc-200/90">
            <p class="text-sm flex items-center gap-2">
                <i class="fa-solid fa-user"></i>
                <span>{{ $news_article['author'] }}</span>
            </p>
            <p class="text-sm flex items-center gap-2">
                <i class="fa-solid fa-calendar-days"></i>
                <span>{{ $news_article['created_at'] }}</span>
            </p>
            <p class="text-sm flex items-center gap-2">
                <i class="fa-solid fa-calendar-plus"></i>
                <span>{{ $news_article['updated_at'] }}</span>
            </p>
        </div>

        <div class="flex gap-4 mb-3 text-zinc-200/90">
            <p class="text-sm flex items-center gap-2">
                <i class="fa-solid fa-heart text-red-400"></i>
                <span>{{ $news_article['likes'] }} Likes</span>
            </p>
            <p class="text-sm flex items-center gap-2">
                <i class="fa-solid fa-comment-dots text-violet-400"></i>
                <span>{{ $news_article['comments'] }} Comments</span>
            </p>
        </div>

        <p class="text-justify text-sm lg:text-base text-zinc-100 line-clamp-3">
            {{ $news_article['content'] }}
        </p>
    </a>
</div>
