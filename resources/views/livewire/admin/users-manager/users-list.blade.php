<div class="bg-indigo-900 rounded-md p-5 text-zinc-200">
    <h1 class="text-2xl font-bold uppercase"><i class="fa-solid fa-users"></i> Registered Users</h1>
    <p class="font-light text-md text-justify">This section provides a complete list of users registered on <span
            class="text-red-500 font-bold">{{ config('app.name') }}</span>. From here, you can search for users and
        select a specific account to manage. Simply click on a user's profile to load their details into the <span
            class="text-red-500 font-bold">User
            Moderator Tools</span> panel. This interface is your starting point for user management tasks, such as
        reviewing account information, updating user roles (within your permission level), or managing their account
        status. Please note that you cannot assign roles higher than your own or perform actions without the necessary
        permissions.</p>
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
        <form wire:submit.prevent="searchUser" x-show="open" x-collapse x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95">
            <div class="my-2">
                <label class="text-md font-bold block mt-3 mb-1" for="first_name">First Name:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="first_name" wire:model="first_name" type="text" placeholder="First Name">

                <label class="text-md font-bold block mt-3 mb-1" for="last_name">Last Name:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="last_name" wire:model="last_name" type="text" placeholder="Last Name">

                <label class="text-md font-bold block mt-3 mb-1" for="first_name">Username:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="username" wire:model="username" type="text" placeholder="Username">

                <label class="text-md font-bold block mt-3 mb-1" for="first_name">E-mail:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="email" wire:model="email" type="text" placeholder="E-mail">
            </div>
            <div class="mt-10 my-2">
                <label class="text-md font-bold block mt-3 mb-1" for="role">Filter by role:</label>
                <select
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="role" wire:model="role">
                    <option value="all_roles" selected>All roles</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>

                <label class="text-md font-bold block mt-3 mb-1" for="order_by">Order by:</label>
                <select
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="order_by" wire:model="order_by">
                    <option value="created_at" selected>Join Date</option>
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="username">Username</option>
                    <option value="email">E-mail</option>
                </select>

                <label class="text-md font-bold block mt-3 mb-1" for="asc_or_desc">Sort by:</label>
                <select
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="sort_by" wire:model="sort_by">
                    <option value="asc" selected>Ascending Order</option>
                    <option value="desc">Descending Order</option>
                </select>

                <label class="text-md font-bold block mt-3 mb-1" for="results_on_page">Results on page:</label>
                <select
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="results_on_page" wire:model="results_on_page">
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                </select>
            </div>
            <div class="my-5 flex flex-row gap-2 w-40">
                <button type="submit"
                    class="mx-auto p-3 uppercase font-bold bg-emerald-500 text-xl rounded-lg mt-5 hover:bg-emerald-700 transition-colors duration-500">Search</button>
                <button type="button" wire:click="resetSearch"
                    class="mx-auto p-3 uppercase font-bold bg-red-500 text-xl rounded-lg mt-5 hover:bg-red-700 transition-colors duration-500">Reset</button>
            </div>
        </form>
    </div>
    <div class="bg-indigo-950 h-96 overflow-y-scroll p-5 mt-5">
        @if (sizeof($users) > 0)
            <div class="flex flex-col gap-5">
                @foreach ($users as $user)
                    <livewire:admin.users-manager.user :wire:key="'user-'.$user['id']" :user_id="$user['id']"
                        :first_name="$user['first_name']" :last_name="$user['last_name']" :username="$user['username']" :email="$user['email']" :banned="$user['banned']" :roles="$user['roles']"
                        :created_at="$user['created_at']" :updated_at="$user['updated_at']" />
                @endforeach
            </div>
        @else
            <h1 class="text-xl font-bold uppercase text-zinc-400">No users found...</h1>
            <p class="font-light text-md text-justify text-zinc-400">There is no user to match your search criteria.</p>
        @endif
    </div>

    @if ($number_of_pages)
        <div class="flex flex-row justify-center mt-5 rounded-lg p-2 lg:p-5 bg-indigo-950 gap-5 text-xs lg:text-lg overflow-x-scroll">
            @if ($current_page - 1 > 1)
                <button type="button" wire:click="firstPage"
                    class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-500 py-2 lg:py-5 rounded min-w-[30px] lg:min-w-[80px] max-w-[200px] overflow-hidden">1</button>
                @if ($current_page - 2 > 1)
                    <span class="bg-indigo-700 py-2 lg:py-5 min-w-[30px] lg:min-w-[80px] text-center rounded">...</span>
                @endif
            @endif

            @if ($current_page - 1 >= 1)
                <button type="button" wire:click="prevPage"
                    class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-500 py-2 lg:py-5 rounded min-w-[30px] lg:min-w-[80px] max-w-[200px] overflow-hidden">{{ $current_page - 1 }}</button>
            @endif

            <span class="bg-indigo-900 py-2 lg:py-5 min-w-[30px] lg:min-w-[80px] text-center rounded">{{ $current_page }}</span>

            @if ($current_page + 1 <= $number_of_pages)
                <button type="button" wire:click="nextPage"
                    class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-500 py-2 lg:py-5 rounded min-w-[30px] lg:min-w-[80px] max-w-[200px] overflow-hidden">{{ $current_page + 1 }}</button>
            @endif

            @if ($current_page + 1 < $number_of_pages)
                @if ($current_page + 2 < $number_of_pages)
                    <span class="bg-indigo-700 py-2 lg:py-5 min-w-[30px] lg:min-w-[80px] text-center rounded">...</span>
                @endif
                <button type="button" wire:click="lastPage"
                    class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-500 py-2 lg:py-5 rounded min-w-[30px] lg:min-w-[80px] max-w-[200px] overflow-hidden">{{ $number_of_pages }}</button>
            @endif
        </div>
    @endif
</div>
