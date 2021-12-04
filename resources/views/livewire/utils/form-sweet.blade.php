<div class="flex my-3">
    <img src="{{url("img/capivara.png")}}" alt="" style="max-width: 100px;">
    <h1 class="text-4xl py-6 font-bold h-24" style="align-items: flex-end;color: #c39b6e;text-shadow: 0.3px 0 black;">Switter</h1>
</div>
<form method="POST" wire:submit.prevent="{{$act}}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
    <label class="block text-gray-700 text-sm font-bold mb-4" for="username">
        Sweet
    </label>
    <textarea style="resize: none;" name="content" id="content" rows="5" placeholder="O que está pensando?" wire:model="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror @if($buttonSub == "Editar") border-green-500 @endif"></textarea></textarea>

    <div class="flex justify-end">
        @if ( $buttonSub == 'Editar' )
            <a class="bg-red-900 text-white p-2 pl-6 pr-6 rounded mx-2" style="cursor: pointer;" wire:click.prevent="cancelUpdate"> Cancelar </a>
        @endif
        <button wire:model="buttonSub" type="submit" class="bg-blue-900 text-white p-2 pl-6 pr-6 rounded"> {{$buttonSub}} Tweet</button>
        @error( 'content' )
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
</form>
