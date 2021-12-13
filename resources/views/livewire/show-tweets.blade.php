<div>
    @if ( $user )
        @include('livewire.utils.show-user-page')
    @endif

    @if ( !$user || $user->id == Auth::user()->id )
        @include('livewire.utils.form-sweet')
    @endif

    @foreach ( $tweets as  $tweet )
        <div class="flex m-8 bg-white shadow-md rounded p-4">
            <div class="w-1/8 pl-3 text-center">
                <a href="/{{$tweet->user->sluguser}}">
                    <img src="{{ asset($tweet->user->photo) }}" alt="{{$tweet->user->name}}" class="rounded-full h-8 w-8">
                </a>
            </div>
            <div class="w-7/8 pl-3 flex" style="flex-direction:column">
                <div>
                    <a href="/{{$tweet->user->sluguser}}">
                        <span class="font-bold h-40">{{$tweet->user->name}}</span>
                    </a>
                </div>
                <div>
                    <div>
                        <span style="white-space: pre-line;">{{$tweet->content}}</span>
                    </div>
                    <div>
                        (
                            @if ( $tweet->user->id == auth()->user()->id )
                                <button  wire:click="deleteConfirm({{$tweet->id}})" class="text-red-500"> <i class="fas fa-trash"></i> </button>
                                | <button  wire:click="edit({{$tweet->id}})" class="{{ $tweet->id == $idEdit ? 'text-green-500' : '' }}"> <i class="fas fa-pencil-ruler"></i> </button>
                                |
                            @endif

                            @if ( $tweet->likes->count() )
                                <a href=""  wire:click.prevent="unlike({{$tweet->id}})" class="text-blue-500"> <i class="fas fa-thumbs-up"></i> </a>
                            @else
                                <a href="" wire:click.prevent="like({{$tweet->id}})" class="text-grey-500"> <i class="fas fa-thumbs-up"></i> </a>
                            @endif
                            |
                            @if ( $tweet->deslikes->count() )
                                <a href=""  wire:click.prevent="undeslike({{$tweet->id}})" class="text-blue-500"> <i class="rotate-180 fas fa-thumbs-up"></i> </a>
                            @else
                                <a href="" wire:click.prevent="deslike({{$tweet->id}})" class="text-grey-500"> <i class="rotate-180 fas fa-thumbs-up"></i> </a>
                            @endif


                        )
                            | ({{$tweet->allLikes->count()}} likes)
                            | ({{$tweet->allDeslikes->count()}} dislikes)
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="py-12">
        {{ $tweets->links() }}
    </div>
</div>
