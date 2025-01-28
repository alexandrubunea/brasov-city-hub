<div @isset($attraction['photo_url']) style="background-image: url('{{ $attraction['photo_url'] }}')" @endisset
    class="h-96 rounded-md bg-no-repeat bg-cover bg-center">
    <div class="bg-zinc-950/70 p-3 h-full w-full rounded-md flex flex-col justify-between">
        <div>
            <h1 class="uppercase text-2xl font-bold">{{ $attraction['name'] }}</h1>
            @if (!empty($attraction['rating']))
                <p class="text-md font-light"><i class="fa-solid fa-star"></i> Rating:
                    {{ $attraction['rating'] }}</p>
            @endif

            @if (!empty($attraction['address']))
                <p class="text-md font-light"><i class="fa-solid fa-location-dot"></i>
                    {{ $attraction['address'] }}
                </p>
            @endif

            @if (!empty($attraction['summary']))
                <p class="text-md font-light text-justify"><i class="fa-solid fa-hand-point-right"></i>
                    {{ $attraction['summary'] }}</p>
            @endif
        </div>
        <a href="{{ $attraction['place_link'] }}" target="_blank"
            class="text-xl bg-indigo-700 hover:bg-indigo-800 transition-all duration-500 hover:scale-105 p-3 rounded-lg w-fit mx-auto flex flex-row gap-2">
            <i class="fa-solid fa-map-pin"></i>
            <span>View on Google Maps</span>
        </a>
    </div>
</div>
