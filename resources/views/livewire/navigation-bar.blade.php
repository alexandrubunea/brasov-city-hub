<div>
    <nav class="bg-slate-900 text-zinc-200 p-5" x-data="{
        open: window.innerWidth >= 1024,
        init() {
            window.addEventListener('resize', () => {
                this.open = window.innerWidth >= 1024 ? true : this.open
            })
        }
    }">
        <div class="flex flex-col lg:flex-row lg:flex-wrap lg:justify-between lg:items-center">
            <div class="flex flex-wrap justify-between">
                <a href="{{ URL('/') }}">
                    <img class="w-32 float-left" src="{{ asset('storage/images/logo.png') }}" alt="Brasov City Hub Logo">
                </a>
                <button type="button" @click="open = !open"
                    class="lg:hidden border-4 border-zinc-200 rounded-lg bg-indigo-700 text-4xl p-3 hover:text-indigo-700 hover:border-indigo-700 hover:bg-zinc-200 transition-all duration-500">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div x-show="open" x-collapse x-cloak x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95">
                <ul
                    class="flex flex-col gap-2 mt-5 p-5 bg-slate-800 rounded-lg lg:mt-0 lg:p-0 lg:bg-transparent lg:rounded-none lg:flex-row lg:justify-between lg:gap-3">
                    @foreach ($tabs as $key => $tab)
                        @if ($tab['active'] == 0)
                            <li
                                class="w-full border border-transparent hover:bg-indigo-700 hover:text-zinc-200 rounded-lg py-3 pl-3 transition-all duration-500 lg:pr-3">
                                <a href="{{ url($tab['route']) }}" class="pr-[100%] lg:pr-0">{{ $key }}</a>
                            </li>
                        @else
                            <li
                                class="w-full border-b-4 border-b-indigo-700 pb-1 pt-3 pl-3 rounded border-t border-x border-t-transparent border-x-transparent hover:border-indigo-700 hover:border-b-zinc-200 hover:rounded-lg hover:bg-indigo-700 transition-all duration-500 lg:pr-3">
                                <a href="{{ url($tab['route']) }}" class="pr-[100%] lg:pr-0">{{ $key }}</a>
                            </li>
                        @endif
                    @endforeach
                    @if (Auth::check())
                        <li
                            class="w-full border border-transparent hover:border-zinc-200 hover:bg-indigo-700 hover:text-zinc-200 rounded-lg py-3 pl-3 transition-all duration-500 lg:pr-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="whitespace-nowrap pr-[100%] lg:pr-0" type="submit">
                                    Log out
                                </button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
