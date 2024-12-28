<div class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-1000 p-5 rounded-md hover:cursor-pointer"
    wire:click="clickUser">
    <h1 class="font-bold text-lg">{{ $first_name . ' ' . $last_name }}</h1>
    <p class="font-light text-sm">
        Username: <span class="text-red-500">{{ $username }}</span> <br>
        E-mail: <span class="text-red-500">{{ $email }}</span> <br>
        Join date: <span class="text-red-500">{{ $created_at }}</span> <br>
        @if (sizeof($roles))
            Roles:
            <span class="text-red-500">
                @foreach ($roles as $role)
                    {{ $role['role_name'] }}
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </span>
        @endif
    </p>
</div>
