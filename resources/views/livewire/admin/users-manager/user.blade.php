<div class="bg-indigo-700 hover:bg-indigo-800 transition-colors duration-1000 p-5 rounded-md hover:cursor-pointer"
    wire:click="clickUser">
    <div class="flex flex-auto gap-5 justify-between">
        <h1 class="font-bold text-lg">{{ $user['first_name'] . ' ' . $user['last_name'] }} </h1>
        @if ($user['banned'])
            <div class="my-auto items-center">
                <span class="uppercase font-bold p-1 bg-red-500 rounded text-xs">banned</span>
            </div>
        @endif
    </div>
    <p class="font-light text-sm">
        Username: <span class="text-red-500">{{ $user['username'] }}</span> <br>
        E-mail: <span class="text-red-500">{{ $user['email'] }}</span> <br>
        Join date: <span class="text-red-500">{{ $user['created_at'] }}</span> <br>
        @if (sizeof($user['roles']))
            Roles:
            <span class="text-red-500">
                @foreach ($user['roles'] as $role)
                    {{ $role['role_name'] }}
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </span>
        @endif
    </p>
</div>
