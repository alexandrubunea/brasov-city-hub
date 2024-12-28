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
            <div class="mt-10">
                <label class="text-md font-bold block mb-1" for="role_name">First Name:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="first_name" wire:model="first_name" type="text" placeholder="First name" required>

                <label class="text-md font-bold block mb-1 mt-3" for="role_name">Last Name:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="last_name" wire:model="last_name" type="text" placeholder="Last name" required>

                <label class="text-md font-bold block mb-1 mt-3" for="role_name">Username:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="username" wire:model="username" type="text" placeholder="Username" required>

                <label class="text-md font-bold block mb-1 mt-3" for="role_name">Email:</label>
                <input
                    class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                    id="email" wire:model="email" type="email" placeholder="Email" required>

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
