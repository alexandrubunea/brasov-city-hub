<div class="bg-indigo-500 p-3 hover:bg-indigo-600 transition-colors duration-500 w-[96%] rounded-lg">
    <a href="{{ route('news.article', ['id' => $news_article['id']]) }}">
        <h1 class="text-lg font-bold">{{ $news_article['title'] }}</h1>
        <p class="text-xs font-light"><i class="fa-solid fa-user"></i> Created by {{ $news_article['author'] }}</p>
        <p class="text-xs font-light"><i class="fa-solid fa-calendar-days"></i> Created on
            {{ $news_article['created_at'] }}</p>
        <p class="text-xs font-light"><i class="fa-solid fa-calendar-plus"></i> Last update on
            {{ $news_article['updated_at'] }}</p>
        <p class="text-xs font-light"><i class="fa-solid fa-heart"></i> {{ $news_article['likes'] }} Likes</p>
        <p class="text-sm font-light"><i class="fa-solid fa-comment-dots"></i> {{ $news_article['comments'] }} Comments</p>
        <p class="mt-2 text-sm text-justify">{{ $news_article['content'] }}</p>
    </a>
</div>
