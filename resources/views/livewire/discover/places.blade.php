<div class="w-[95%] lg:w-2/3 mx-auto mb-10">
    <div class="bg-gradient-to-br from-indigo-500 to-rose-500 rounded-lg p-5 text-zinc-200">
        <h1 class="uppercase font-bold text-3xl flex gap-2">
            <i class="fa-solid fa-map-location-dot"></i>
            <span>Explore The City</span>
        </h1>

        <div class="mt-5 flex flex-col gap-5">
            @forelse ($attractions as $attraction)
               <livewire:discover.place :attraction="$attraction" :wire:key="$attraction['id']" /> 
            @empty
                <h1 class="uppercase font-bold text-xl text-zinc-600 text-justify">
                    Something went wrong trying to fetch the touristic attractions. Please try again later...
                </h1>
            @endforelse
        </div>
    </div>
</div>
