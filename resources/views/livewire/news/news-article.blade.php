<div class="bg-indigo-500 p-3 hover:bg-indigo-600 transition-colors duration-500 w-[96%] rounded-lg">
    <a href="#">
        <h1 class="text-lg font-bold">{{ $title }}</h1>
        <p class="text-xs font-light"><i class="fa-solid fa-user"></i> Created by {{ $author }}</p>
        <p class="text-xs font-light"><i class="fa-solid fa-calendar-days"></i> Created on {{ $created_on }}</p>
        <p class="text-xs font-light"><i class="fa-solid fa-calendar-plus"></i> Last update on {{ $updated_on }}</p>
        <p class="text-xs font-light"><i class="fa-solid fa-heart"></i> {{ $likes }} Likes</p>
        <p class="text-sm text-justify">{{ $content }}</p>
    </a>
</div>
