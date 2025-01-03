<div class="bg-sky-950 rounded-md p-5 text-zinc-200">
    <h1 class="text-2xl font-bold uppercase"><i class="fa-solid fa-user-shield"></i> User Moderator Tools</h1>
    <p class="font-light text-md text-justify">This panel is where you manage the details of the user selected from the
        <span class="text-red-500 font-bold">Registered Users</span> list. You can edit their first name, last name,
        username, and email address, update their role,
        or take moderation actions such as banning or unbanning the user. However, password changes are not permitted
        for security reasons. Exercise caution when making modifications, as all changes impact the user’s account
        directly. Remember: <span class="text-red-500 font-bold">Great power comes with great responsibility!</span>
    </p>
    <hr class="my-3">
    @if ($user_loaded)
        <form class="bg-sky-900 rounded-lg p-5" wire:submit.prevent="updateUser">
            <h1 class="text-xl font-bold">{{ $first_name . ' ' . $last_name }} (<span
                    class="text-red-500 font-bold">{{ $username }}</span>)</h1>
            <p class="font-light text-xs">
                <i class="fa-solid fa-clock"></i> Created on: {{ $created_at }}<br>
                <i class="fa-solid fa-rotate"></i> Last updated: {{ $updated_at }}<br>
            </p>
            @if ($users_moderator)
                <div class="mt-10">
                    <label class="text-md font-bold block mb-1" for="first_name">First Name:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="first_name" wire:model="first_name" type="text" placeholder="First name" required>

                    <label class="text-md font-bold block mb-1 mt-3" for="last_name">Last Name:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="last_name" wire:model="last_name" type="text" placeholder="Last name" required>

                    <label class="text-md font-bold block mb-1 mt-3" for="username">Username:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="username" wire:model="username" type="text" placeholder="Username" required>

                    <label class="text-md font-bold block mb-1 mt-3" for="email">Email:</label>
                    <input
                        class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                        id="email" wire:model="email" type="email" placeholder="Email" required>
            @endif
            @if ($roles_moderator)
                <p class="text-md font-bold mt-10 mb-1">Roles:</p>
                <div class="flex flex-row gap-2">
                    @forelse ($roles as $role)
                        <span
                            class="p-3 font-bold text-sm rounded @if ($role['roles_moderator']) cursor-not-allowed @else hover:cursor-pointer @endif bg-zinc-900"
                            wire:click="removeRole({{ $role['id'] }})"><i
                                class="fa-solid fa-circle-xmark mr-3"></i>{{ $role['role_name'] }}</span>
                    @empty
                        <span class="p-3 font-bold text-sm rounded bg-zinc-900">No roles...</span>
                    @endforelse
                </div>

                <label class="text-md font-bold block mt-5 mb-1" for="add_role">Select a role to
                    add:</label>
                <div class="flex flex-col lg:flex-row gap-2" wire:prevent.submit="addRole">
                    <div>
                        <select
                            class="w-72 lg:w-96 text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3 overflow-hidden"
                            id="add_role" wire:model="role_to_add">
                            <option value="-1" selected></option>
                            @foreach ($available_roles as $a_role)
                                <option value="{{ $a_role['id'] }}">{{ $a_role['role_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" wire:click="addRole"
                        class="w-72 lg:w-auto bg-zinc-800 hover:bg-zinc-900 font-bold uppercase rounded-lg p-3 transition-colors duration-500">Add
                        Role</button>
                </div>
            @endif
            <div class="flex flex-row mt-10">
                <button type="submit"
                    class="bg-emerald-500 hover:bg-emerald-700 font-bold uppercase rounded-lg p-3 transition-colors duration-500">
                    Update
                </button>
                <button type="button"
                    class="bg-red-500 hover:bg-red-700 font-bold uppercase rounded-lg p-3 transition-colors duration-500 ml-3"
                    wire:click="closeUser">
                    Close
                </button>
            </div>
        </form>
</div>
@else
<h1 class="text-xl font-bold uppercase text-zinc-400">No user loaded...</h1>
<p class="font-light text-md text-justify text-zinc-400">Please select a user from the list to view their
    details
    and manage their account.</p>
@endif
</div>
