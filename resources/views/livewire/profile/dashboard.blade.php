<div class="w-[95%] lg:w-2/3 mx-auto text-zinc-200">
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg">
        <div class="grid grid-rows-2 md:grid-rows-none md:grid-cols-2">
            <div class="border-b md:border-b-0 md:border-r border-indigo-600/50 transition-all">
                <button type="button" wire:click="changeTab('your_informations')" 
                    class="p-4 md:p-6 transition-all hover:bg-indigo-700/30 rounded-tl-lg w-full">
                    <div class="@if($active_tab == 'your_informations') text-white @else text-zinc-400 @endif">
                        <i class="fa-solid fa-user-tie text-2xl mb-2"></i>
                        <p class="text-lg font-bold tracking-wide">Your Information</p>
                    </div>
                </button>
            </div>
            <div class="transition-all">
                <button type="button" wire:click="changeTab('settings')"
                    class="p-4 md:p-6 transition-all hover:bg-indigo-700/30 rounded-tr-lg w-full">
                    <div class="@if($active_tab == 'settings') text-white @else text-zinc-400 @endif">
                        <i class="fa-solid fa-user-gear text-2xl mb-2"></i>
                        <p class="text-lg font-bold tracking-wide">Settings</p>
                    </div>
                </button>
            </div>
        </div>
    </div>

    @if ($active_tab == 'your_informations')
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-8 mt-6">
            @if ($banned)
                <livewire:Alert title="THIS ACCOUNT IS BANNED"
                    message="This account was banned as a result of breaking our community guidelines. Your account will be restricted from certain actions."
                    type="error" />
            @endif

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-zinc-900/20 p-4 rounded-xl">
                        <p class="text-zinc-400 text-sm mb-1">First Name</p>
                        <p class="text-lg">{{ $first_name }}</p>
                    </div>
                    <div class="bg-zinc-900/20 p-4 rounded-xl">
                        <p class="text-zinc-400 text-sm mb-1">Last Name</p>
                        <p class="text-lg">{{ $last_name }}</p>
                    </div>
                    <div class="bg-zinc-900/20 p-4 rounded-xl">
                        <p class="text-zinc-400 text-sm mb-1">Username</p>
                        <p class="text-lg">{{ $username }}</p>
                    </div>
                    <div class="bg-zinc-900/20 p-4 rounded-xl">
                        <p class="text-zinc-400 text-sm mb-1">Email</p>
                        <p class="text-lg">{{ $email }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-zinc-900/20 p-4 rounded-xl text-center">
                        <p class="text-zinc-400 text-sm mb-1">Comments</p>
                        <p class="text-2xl font-bold">{{ $comments_created }}</p>
                    </div>
                    @if ($is_news_creator)
                        <div class="bg-zinc-900/20 p-4 rounded-xl text-center">
                            <p class="text-zinc-400 text-sm mb-1">News Created</p>
                            <p class="text-2xl font-bold">{{ $news_created }}</p>
                        </div>
                    @endif
                    @if ($is_discussions_creator)
                        <div class="bg-zinc-900/20 p-4 rounded-xl text-center">
                            <p class="text-zinc-400 text-sm mb-1">Discussions</p>
                            <p class="text-2xl font-bold">{{ $discussions_created }}</p>
                        </div>
                    @endif
                </div>

                <div class="bg-zinc-900/20 p-4 rounded-xl mt-6">
                    <p class="text-zinc-400 text-sm mb-1">Member Since</p>
                    <p class="text-lg">{{ $created_at }}</p>
                </div>
            </div>
        </div>
    @endif

    @if ($active_tab == 'settings')
        <form wire:submit="updateUser" class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-8 mt-6" autocomplete="off">
        <input type="password" name="password_hidden" class="hidden">
        <input type="email" name="email_hidden" class="hidden">
            <div class="space-y-6">
                <div class="space-y-6">
                    <h2 class="text-xl font-bold mb-6">E-mail Settings</h2>
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2" for="new_email">New E-mail</label>
                        <input
                            class="w-full bg-zinc-900/20 text-white rounded-xl border-2 border-transparent p-3 transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/50 placeholder-zinc-400"
                            wire:model="new_email"
                            type="email"
                            id="new_email"
                            placeholder="Enter new e-mail address">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2" for="confirm_email">Confirm E-mail</label>
                        <input
                            class="w-full bg-zinc-900/20 text-white rounded-xl border-2 border-transparent p-3 transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/50 placeholder-zinc-400"
                            wire:model="confirm_email"
                            type="email"
                            id="confirm_email"
                            placeholder="Confirm new e-mail address">
                    </div>
                </div>

                <div class="border-t border-indigo-700/50 pt-6 space-y-6">
                    <h2 class="text-xl font-bold mb-6">Password Settings</h2>
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2" for="current_password">Current Password</label>
                        <input
                            class="w-full bg-zinc-900/20 text-white rounded-xl border-2 border-transparent p-3 transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/50 placeholder-zinc-400"
                            wire:model="current_password"
                            type="password"
                            placeholder="Enter current password">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2" for="new_password">New Password</label>
                        <input
                            class="w-full bg-zinc-900/20 text-white rounded-xl border-2 border-transparent p-3 transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/50 placeholder-zinc-400"
                            wire:model="new_password"
                            type="password"
                            placeholder="Enter new password">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2" for="confirm_password">Confirm Password</label>
                        <input
                            class="w-full bg-zinc-900/20 text-white rounded-xl border-2 border-transparent p-3 transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/50 placeholder-zinc-400"
                            wire:model="confirm_password"
                            type="password"
                            placeholder="Confirm new password">
                    </div>
                </div>

                <button type="submit"
                    class="w-full md:w-auto px-8 py-4 bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 rounded-xl font-bold transition-all duration-500 flex items-center justify-center gap-2 mt-8">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Save Changes</span>
                </button>
            </div>
        </form>
    @endif
</div>
