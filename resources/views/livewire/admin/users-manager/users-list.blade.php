<div class="bg-indigo-900 rounded-md p-5 text-zinc-200">
    <h1 class="text-2xl font-bold uppercase"><i class="fa-solid fa-users"></i> Registered Users</h1>
    <p class="font-light text-md">Below is the complete list of users registered on <span
            class="text-red-500 font-bold">{{ config('app.name') }}</span>. From this interface, you can manage user
        roles or ban/unban accounts. Please note that you cannot assign roles higher than your own. However, you can
        remove your own roles, so proceed with caution.</p>
    <hr class="my-3">
    <div class="rounded-lg p-5 bg-indigo-950" x-data="{ open: false }">
        <div class="flex flex-row justify-between">
            <div class="my-auto">
                <h1 class="text-xl font-bold uppercase"><i class="fa-solid fa-magnifying-glass mr-3"></i>Search Tool
                </h1>
            </div>
            <button class="text-zinc-200 bg-zinc-950 rounded-xl p-3" @click="open = !open"><i class="fa-solid"
                    :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i></button>
        </div>
        <form wire:prevent="searchUser" x-show="open" x-collapse x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95">
            <div class="my-2">
                <label class="text-md font-bold block mb-1" for="first_name">First Name:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="first_name" wire:model="first_name" type="text" placeholder="First Name">
            </div>
            <div class="my-2">
                <label class="text-md font-bold block mb-1" for="last_name">Last Name:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="last_name" wire:model="last_name" type="text" placeholder="Last Name">
            </div>
            <div class="my-2">
                <label class="text-md font-bold block mb-1" for="first_name">Username:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="username" wire:model="username" type="text" placeholder="Username">
            </div>
            <div class="my-2">
                <label class="text-md font-bold block mb-1" for="first_name">E-mail:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="email" wire:model="email" type="text" placeholder="E-mail">
            </div>
            <div class="my-2">
                <label class="text-md font-bold block mb-1" for="role">Filter by role:</label>
                <select
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="role" wire:model="role">
                    <option value="all_roles" selected>All roles</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-2 flex flex-row gap-2 w-40">
                <button type="submit"
                    class="mx-auto p-3 uppercase font-bold bg-emerald-500 text-xl rounded-lg mt-5 hover:bg-emerald-700 transition-colors duration-500">Search</button>
                <button type="button" livewire:click=""
                    class="mx-auto p-3 uppercase font-bold bg-red-500 text-xl rounded-lg mt-5 hover:bg-red-700 transition-colors duration-500">Reset</button>
            </div>
        </form>
    </div>
    <div class="flex flex-col mt-5 rounded-lg p-5 bg-indigo-950 max-h-96 overflow-y-scroll gap-5">
        @foreach ($users as $user)
            <livewire:admin.users-manager.user :first_name="$user->first_name" :last_name="$user->last_name" :username="$user->username" :email="$user->email"
                :created_at="$user->created_at" />
        @endforeach
    </div>
</div>
