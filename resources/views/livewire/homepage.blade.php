<div class="bg-slate-950 text-zinc-200 bg-no-repeat bg-fixed"
    style="background-image: url({{ asset('storage/images/background.jpg') }})">
    <div class="relative h-screen flex items-center justify-center overflow-hidden bg-zinc-900/80">
        <div class="relative mt-10 h-screen text-center px-4 sm:px-6 lg:px-8 max-w-5xl">
            <h1
                class="text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 bg-gradient-to-r from-indigo-400 to-violet-400 text-transparent bg-clip-text">
                Welcome to Brașov City Hub
            </h1>
            <p class="text-xl md:text-2xl text-zinc-200 mb-8 max-w-3xl mx-auto">
                Your digital gateway to Brașov's vibrant community. Discover local events, join discussions, stay
                updated with news, and connect with fellow citizens.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#explore"
                    class="text-3xl hover:scale-125 px-6 py-3 bg-indigo-500 hover:bg-indigo-600 rounded-lg font-semibold transition-all duration-500 flex items-center gap-2">
                    <i class="fa-solid fa-compass"></i>
                    Start Exploring
                </a>
            </div>
        </div>
    </div>
    <div class="bg-indigo-800 md:py-52" id="explore">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    class="group bg-indigo-500 rounded-xl p-6 hover:bg-indigo-600 transition-all duration-300 transform hover:-translate-y-1">
                    <a href="{{ route('discover.view') }}" class="block">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <i
                                    class="fa-solid fa-compass text-3xl group-hover:rotate-45 transition-transform duration-300"></i>
                                <h2 class="text-2xl font-bold">Discover</h2>
                            </div>
                            <i
                                class="fa-solid fa-arrow-right opacity-0 group-hover:opacity-100 transform -translate-x-5 group-hover:translate-x-0 transition-all duration-300"></i>
                        </div>
                        <p class="text-zinc-200/90">Explore the best tourist attractions, hidden gems, and local
                            favorites
                            in Brașov.</p>
                    </a>
                </div>

                <div
                    class="group bg-indigo-500 rounded-xl p-6 hover:bg-indigo-600 transition-all duration-300 transform hover:-translate-y-1">
                    <a href="{{ route('discussions.view') }}" class="block">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <i
                                    class="fa-solid fa-comments text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                                <h2 class="text-2xl font-bold">Discussions</h2>
                            </div>
                            <i
                                class="fa-solid fa-arrow-right opacity-0 group-hover:opacity-100 transform -translate-x-5 group-hover:translate-x-0 transition-all duration-300"></i>
                        </div>
                        <p class="text-zinc-200/90">Join community discussions about events, activities, and city life.
                        </p>
                    </a>
                </div>

                <div
                    class="group bg-indigo-500 rounded-xl p-6 hover:bg-indigo-600 transition-all duration-300 transform hover:-translate-y-1">
                    <a href="{{ route('news.view') }}" class="block">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <i
                                    class="fa-solid fa-newspaper text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                                <h2 class="text-2xl font-bold">News</h2>
                            </div>
                            <i
                                class="fa-solid fa-arrow-right opacity-0 group-hover:opacity-100 transform -translate-x-5 group-hover:translate-x-0 transition-all duration-300"></i>
                        </div>
                        <p class="text-zinc-200/90">Stay updated with the latest news and developments from around the
                            city.
                        </p>
                    </a>
                </div>

                <div
                    class="group bg-indigo-500 rounded-xl p-6 hover:bg-indigo-600 transition-all duration-300 transform hover:-translate-y-1">
                    <a href="/register" class="block">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <i
                                    class="fa-solid fa-right-to-bracket text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                                <h2 class="text-2xl font-bold">Register</h2>
                            </div>
                            <i
                                class="fa-solid fa-arrow-right opacity-0 group-hover:opacity-100 transform -translate-x-5 group-hover:translate-x-0 transition-all duration-300"></i>
                        </div>
                        <p class="text-zinc-200/90">Join our community to participate in discussions and get
                            personalized
                            updates.</p>
                    </a>
                </div>

                <div
                    class="@if (!($is_users_moderator || $is_roles_moderator)) md:col-span-2 @endif group bg-indigo-500 rounded-xl p-6 hover:bg-indigo-600 transition-all duration-300 transform hover:-translate-y-1">
                    <a href="{{ route('profile.view') }}" class="block">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <i
                                    class="fa-solid fa-user text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                                <h2 class="text-2xl font-bold">Profile</h2>
                            </div>
                            <i
                                class="fa-solid fa-arrow-right opacity-0 group-hover:opacity-100 transform -translate-x-5 group-hover:translate-x-0 transition-all duration-300"></i>
                        </div>
                        <p class="text-zinc-200/90">Access your personal profile, manage settings, and track your
                            activity.
                        </p>
                    </a>
                </div>
                @if ($is_users_moderator || $is_roles_moderator)
                    <div
                        class="group bg-indigo-500 rounded-xl p-6 hover:bg-indigo-600 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex flex-col h-full">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <i
                                        class="fa-solid fa-shield-halved text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                                    <h2 class="text-2xl font-bold">Admin</h2>
                                </div>
                            </div>
                            <p class="text-zinc-200/90 mb-4">Administrative tools and management options.</p>
                            <div class="flex flex-col gap-2 mt-auto">
                                @if ($is_roles_moderator)
                                    <a href="{{ route('roles.view') }}"
                                        class="flex items-center justify-between p-2 bg-indigo-700 rounded-lg hover:bg-indigo-800 transition-all duration-300">
                                        <span class="flex items-center gap-2">
                                            <i class="fa-solid fa-user-gear"></i>
                                            Manage Roles
                                        </span>
                                        <i
                                            class="fa-solid fa-arrow-right opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                    </a>
                                @endif
                                @if ($is_users_moderator)
                                    <a href="{{ route('users.view') }}"
                                        class="flex items-center justify-between p-2 bg-indigo-700 rounded-lg hover:bg-indigo-800 transition-all duration-300">
                                        <span class="flex items-center gap-2">
                                            <i class="fa-solid fa-users-gear"></i>
                                            Manage Users
                                        </span>
                                        <i
                                            class="fa-solid fa-arrow-right opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="bg-slate-950 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4">
                    <div class="text-4xl font-bold mb-2">{{ $users_count }}</div>
                    <div class="text-zinc-200/90">Community Members</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold mb-2">{{ $news_count }}</div>
                    <div class="text-zinc-200/90">News Articles</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold mb-2">{{ $discussions_count }}</div>
                    <div class="text-zinc-200/90">Active Discussions</div>
                </div>
                <div class="p-4">
                    <div class="text-4xl font-bold mb-2">{{ $comments_count }}</div>
                    <div class="text-zinc-200/90">Comments</div>
                </div>
            </div>
        </div>
    </div>
</div>
