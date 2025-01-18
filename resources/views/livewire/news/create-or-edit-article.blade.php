<div class="bg-indigo-500 p-5 my-5 text-zinc-200 rounded-lg max-w-[95%] mx-auto">
    <h1 class="text-2xl font-bold mt-5"><i class="fa-solid fa-feather"></i>
        @if ($mode == 'create')
            Create a new article
        @else
            Editing exiting article...
        @endif
    </h1>
    @if ($mode == 'edit')
        <div class="ml-5 text-zinc-300 mt-2 mb-5">
            <p class="text-light text-sm"><i class="fa-solid fa-user"></i> Created by {{ $author }} </p>
            <p class="text-light text-sm"><i class="fa-solid fa-clock"></i> Created at {{ $created_at }}</p>
            <p class="text-light text-sm"><i class="fa-solid fa-clock-rotate-left"></i> Last change at {{ $updated_at }}
            </p>
        </div>
    @endif
    <hr class="my-5">
    <form wire:submit.prevent="saveArticle">
        <label class="text-md font-bold block mb-1" for="title">Title:</label>
        <input
            class="w-full text-zinc-900 border rounded-lg focus:border-zinc-900 focus:outline-none focus:ring-0 bg-zinc-100 p-3"
            id="title" wire:model="title" type="text" placeholder="Title of the article..." required>
        <div class="my-5">
            <p class="text-md font-bold block mb-1">Content:</p>
            @if ($mode == 'edit')
                <livewire:RichTextEditor :initialContent="$content" />
            @else
                <livewire:RichTextEditor />
            @endif
        </div>
        <div class="flex justify-center">
            <button type="submit"
                class="uppercase text-lg rounded-lg bg-emerald-500 hover:bg-emerald-600 transition-colors duration-500 p-5 font-bold"><i
                    class="fa-solid fa-floppy-disk"></i> Save Article</button>
        </div>
    </form>
</div>
