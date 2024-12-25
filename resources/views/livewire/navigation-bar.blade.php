<div>
    <nav class="bg-slate-900 text-zinc-200 p-5">
        <div class="flex flex-wrap justify-between">
            <a href="{{ URL('/') }}">
                <img class="w-32" src="{{ asset('storage/images/logo.png') }}" alt="Brasov City Hub Logo">
            </a>
            <ul class="font-sans font-light flex flex-wrap justify-evenly gap-5 items-center">
                @foreach ($tabs as $key => $tab)
                    <li><a href="{{ url($tab['route']) }}"
                            @if ($tab['active'] == 0) class="border border-transparent hover:border-zinc-200 hover:bg-indigo-700 hover:text-zinc-200 rounded-lg p-3 transition-all duration-500"
                        @else class="border-b-4 border-b-indigo-700 pb-1 px-3 pt-3 rounded border-t border-x border-t-transparent border-x-transparent hover:border-x-zinc-200 hover:border-zinc-200 hover:rounded-lg hover:bg-indigo-700 transition-all duration-500" @endif>{{ $key }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</div>
