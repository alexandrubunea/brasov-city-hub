<div class="bg-blue-950 p-5 text-zinc-200 rounded-lg">
    <h1 class="font-bold uppercase text-2xl"><i class="fa-solid fa-shield-halved"></i> Manage roles</h1>
    <p class="font-light text-md text-justify">Modify or delete already existing roles, use with caution, you will not
        be prevented
        to delete or edit <span class="text-red-500">your own role that allows you to do these changes</span>.</p>
    <hr class="my-3">
    <div class="flex flex-col gap-5 rounded max-h-96 overflow-y-scroll">
        @foreach ($roles as $role)
            <livewire:admin.roles-manager.role :wire:key="'role-'.$role->id" :role="$role" />
        @endforeach
    </div>
</div>
