<div>
    <div class="flex mb-4 gap-3">
        <div class="rounded-full w-12 h-12 bg-gray-200 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>

            {{-- <img src="https://picsum.photos/200" alt="" > --}}
        </div>
        <div>
            <div>
                <a href="#" class="text-indigo-600 font-semibold">
                    {{ $comment->user->name }}
                </a>
                - <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>

            @if ($editing)
                <livewire:comment-create :comment-model="$comment" />
            @else
                <div class=" text-gray-700">
                    {{ $comment->comment }}
                </div>
            @endif

            <div>
                <a href="#" wire:click.prevent="startReply" class="text-indigo-600 text-sm mr-3">Reply</a>
                @if (auth()->id() == $comment->user_id)
                    <a wire:click.prevent="startCommentEdit" href="#" class="text-blue-600 text-sm mr-3">Edit</a>
                    <a wire:click.prevent="deleteComment" href="#" class="text-red-600 text-sm">Delete</a>
                @endif
            </div>

            @if ($replying)
                <livewire:comment-create :post="$comment->post" :parent-comment="$comment" />
            @endif

            @if ($comment->comments->count())
                <div class="mt-4">
                    @foreach ($comment->comments as $childComment)
                        <livewire:comment-item :comment="$childComment" wire:key="comment-{{ $childComment->id }}" />
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>
