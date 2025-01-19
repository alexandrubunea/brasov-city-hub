<div class="mb-20">
    <nav class="bg-slate-900 text-zinc-200 fixed top-0 z-50 w-full" x-data="{
        open: false,
        screenWidth: window.innerWidth,
        init() {
            this.$watch('screenWidth', value => {
                if (value >= 1024) this.open = false;
            });
    
            window.addEventListener('resize', () => {
                this.screenWidth = window.innerWidth;
            });
    
            document.addEventListener('click', (e) => {
                if (!this.$el.contains(e.target) && this.open) {
                    this.open = false;
                }
            });
        }
    }">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="{{ URL('/') }}" class="block">
                        <img class="h-8 w-auto sm:h-10" src="{{ asset('storage/images/logo.png') }}"
                            alt="Brasov City Hub Logo">
                    </a>
                </div>

                <div class="hidden lg:block">
                    <div class="flex items-center space-x-4">
                        <ul class="flex items-center space-x-4">
                            @foreach ($tabs as $key => $tab)
                                <li>
                                    <a href="{{ url($tab['route']) }}"
                                        class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-300
                                        {{ $tab['active'] == 1
                                            ? 'bg-indigo-700 text-white border-b-2 border-zinc-200'
                                            : 'text-zinc-200 hover:bg-indigo-700 hover:text-white' }}">
                                        {{ $key }}
                                    </a>
                                </li>
                            @endforeach

                            @if (Auth::check() && ($is_roles_moderator || $is_users_moderator))
                                <div class="relative" x-data="{ open_manage_menu: false }">
                                    <button @click="open_manage_menu = !open_manage_menu"
                                        class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-300
                                        {{ $active_tab == 'manage'
                                            ? 'bg-indigo-700 text-white border-b-2 border-zinc-200'
                                            : 'text-zinc-200 hover:bg-indigo-700 hover:text-white' }}">
                                        Manage
                                    </button>

                                    <div x-cloak x-show="open_manage_menu" @click.away="open_manage_menu = false"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 transform translate-y-0"
                                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-slate-800 ring-1 ring-black ring-opacity-5">
                                        <div class="py-1">
                                            @if ($is_users_moderator)
                                                <a href="{{ route('users.view') }}"
                                                    class="block px-4 py-2 text-sm text-zinc-200 hover:bg-indigo-700 hover:text-white transition-all duration-300">
                                                    Manage Users
                                                </a>
                                            @endif
                                            @if ($is_roles_moderator)
                                                <a href="{{ route('roles.view') }}"
                                                    class="block px-4 py-2 text-sm text-zinc-200 hover:bg-indigo-700 hover:text-white transition-all duration-300">
                                                    Manage Roles
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (Auth::check())
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-2 rounded-md text-sm font-medium text-zinc-200 hover:bg-indigo-700 hover:text-white transition-all duration-300">
                                            Log out
                                        </button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="flex lg:hidden">
                    <button @click="open = !open" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-zinc-200 hover:bg-indigo-700 hover:text-white focus:outline-none transition-all duration-300"
                        aria-controls="mobile-menu" :aria-expanded="open">
                        <span class="sr-only">Open main menu</span>
                        <div :class="{ 'hidden': open, 'block': !open }">
                            <i class="fa-solid fa-bars h-6 w-6 my-auto text-lg"></i>
                        </div>
                        <div :class="{ 'block': open, 'hidden': !open }">
                            <i class="fa-solid fa-x h-6 w-6 my-auto text-lg"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="lg:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @foreach ($tabs as $key => $tab)
                    <a href="{{ url($tab['route']) }}"
                        class="block px-3 py-2 rounded-md text-base font-medium transition-all duration-300
                        {{ $tab['active'] == 1 ? 'bg-indigo-700 text-white' : 'text-zinc-200 hover:bg-indigo-700 hover:text-white' }}">
                        {{ $key }}
                    </a>
                @endforeach

                @if (Auth::check() && ($is_roles_moderator || $is_users_moderator))
                    <div x-data="{ open_mobile_manage: false }">
                        <button @click="open_mobile_manage = !open_mobile_manage"
                            class="w-full text-left px-3 py-2 rounded-md text-base font-medium transition-all duration-300
                            {{ $active_tab == 'manage' ? 'bg-indigo-700 text-white' : 'text-zinc-200 hover:bg-indigo-700 hover:text-white' }}">
                            Manage
                        </button>

                        <div x-cloak x-show="open_mobile_manage" class="pl-4 space-y-1">
                            @if ($is_users_moderator)
                                <a href="{{ route('users.view') }}"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-zinc-200 hover:bg-indigo-700 hover:text-white transition-all duration-300">
                                    Manage Users
                                </a>
                            @endif
                            @if ($is_roles_moderator)
                                <a href="{{ route('roles.view') }}"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-zinc-200 hover:bg-indigo-700 hover:text-white transition-all duration-300">
                                    Manage Roles
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-zinc-200 hover:bg-indigo-700 hover:text-white transition-all duration-300">
                            Log out
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </nav>
</div>
