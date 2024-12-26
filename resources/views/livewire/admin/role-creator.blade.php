<div class="bg-slate-700 p-5 text-zinc-200 rounded-md">
    <h1 class="font-bold uppercase text-2xl">Create new role</h1>
    <p class="font-light text-md">Create the roles that you need in a responsible manner, this is the most powerful
        action.</p>
    <hr class="my-3">
    @if ($errors->any())
        <livewire:Alert type="error" title="ERROR OCCURED" message="{{ $errors->first() }}" />
    @endif
    <form wire:submit.prevent="createRoleForm">
        <div class="mb-5">
            <label class="text-md font-bold block mb-1" for="role_name">The name of the role:</label>
            <input
                class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
                id="role_name" wire:model="role_name" type="text" placeholder="Name of the role" required>
        </div>
        <div class="mb-2">
            <label class="inline-flex items-center me-5 cursor-pointer">
                <input type="checkbox" class="sr-only peer" id="news_creator" wire:model="news_creator" value="true">
                <div
                    class="relative w-11 h-6 bg-slate-900 rounded-full peer peer-focus:ring peer-focus:ring-red-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-zinc-900 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-700">
                </div>
                <span class="ml-5 text-lg font-bold text-zinc-200 uppercase"><i class="fa-solid fa-newspaper mr-2"></i>
                    create news</span>
            </label>
        </div>
        <div class="mb-5">
            <label class="inline-flex items-center me-5 cursor-pointer">
                <input type="checkbox" class="sr-only peer" id="news_moderator" wire:model="news_moderator"
                    value="true">
                <div
                    class="relative w-11 h-6 bg-slate-900 rounded-full peer peer-focus:ring peer-focus:ring-red-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-zinc-900 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-700">
                </div>
                <span class="ml-5 text-lg font-bold text-zinc-200 uppercase"><i class="fa-solid fa-hammer mr-2"></i>
                    moderate
                    news</span>
            </label>
        </div>
        <div class="mb-2">
            <label class="inline-flex items-center me-5 cursor-pointer">
                <input type="checkbox" class="sr-only peer" id="discussions_creator" wire:model="discussions_creator"
                    value="true">
                <div
                    class="relative w-11 h-6 bg-slate-900 rounded-full peer peer-focus:ring peer-focus:ring-red-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-zinc-900 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-700">
                </div>
                <span class="ml-5 text-lg font-bold text-zinc-200 uppercase"><i
                        class="fa-solid fa-comments mr-2"></i>create
                    discussions</span>

            </label>
        </div>
        <div class="mb-5">
            <label class="inline-flex items-center me-5 cursor-pointer">
                <input type="checkbox" class="sr-only peer" id="discussions_moderator"
                    wire:model="discussions_moderator" value="true">
                <div
                    class="relative w-11 h-6 bg-slate-900 rounded-full peer peer-focus:ring peer-focus:ring-red-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-zinc-900 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-700">
                </div>
                <span class="ml-5 text-lg font-bold text-zinc-200 uppercase"><i
                        class="fa-solid fa-screwdriver-wrench mr-2"></i> moderate discussions</span>

            </label>
        </div>
        <div class="mb-5">
            <label class="inline-flex items-center me-5 cursor-pointer">
                <input type="checkbox" class="sr-only peer" id="users_moderator" wire:model="users_moderator"
                    value="true">
                <div
                    class="relative w-11 h-6 bg-slate-900 rounded-full peer peer-focus:ring peer-focus:ring-red-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-zinc-900 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-700">
                </div>
                <span class="ml-5 text-lg font-bold text-zinc-200 uppercase"><i class="fa-solid fa-users mr-2"></i>
                    moderate users</span>
            </label>
        </div>
        <div class="mb-5">
            <label class="inline-flex items-center me-5 cursor-pointer">
                <input type="checkbox" class="sr-only peer" id="roles_moderator" wire:mode="roles_moderator"
                    value="true">
                <div
                    class="relative w-11 h-6 bg-slate-900 rounded-full peer peer-focus:ring peer-focus:ring-red-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-zinc-900 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-700">
                </div>
                <span class="ml-5 text-lg font-bold text-red-500 uppercase"><i class="fa-solid fa-crown mr-2"></i>
                    moderate roles</span>
            </label>
        </div>
        <div class="flex">
            <button type="submit"
                class="mx-auto p-3 uppercase font-bold bg-indigo-600 text-xl rounded-lg mt-5 hover:bg-indigo-800 transition-colors duration-500">Create
                role</button>
        </div>
    </form>
</div>
