<div class="my-auto" x-data="{ lista: document.querySelector('#list-sch'), toggleDiv(div, e){ div.textContent = ''; div.style.display = 'none'; }}" x-on:click.away="toggleDiv(lista, $event) ">

    <input autocomplete="false" x-on:focus=" Livewire.emit('search') " wire:keyup='searchRegisters' wire:model="search" type="text" placeholder="Pesquisar..." class="{{$styleList[1]}} appearance-none block w-full bg-yellow-200 text-yellow-700 border border-yellow-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-yellow-500" name="search">
    <div id="list-sch" class="{{$styleList[0]}} bg-yellow-200 text-yellow-700 border border-white-200 rounded rounded-t-none py-3 px-1" style=" width:220px; position: absolute;top: 55px;flex-direction: column;" >
        @if ($retorno_lista)
            <h4 class="text-center font-bold"> Usuários </h4>
            @forelse ( $retorno_lista[0] as $item )
                <a href="/{{$item->sluguser}}" class="py-3 hover:bg-yellow-400">
                    <span class="flex flex-row justify-start items-center font-bold" >
                        <img src="{{asset($item->photo)}}" alt="{{$item->name}}" class="rounded-full h-8 w-8 mx-2">
                        {{$item->name}}
                    </span>
                </a>
            @empty
                <span class="text-center font-semibold">Nenhum usuário encontrado</span>
            @endforelse
            <h4 class="text-center font-bold"> Sweets </h4>
            @forelse ( $retorno_lista[1] as $item )
                <a href="/{{$item->sluguser}}" class="py-3 hover:bg-yellow-400">
                    <span class="flex flex-row justify-start items-center font-bold " >
                        <img src="{{asset($item->user->photo)}}" alt="{{$item->user->name}}" class="rounded-full h-8 w-8 mx-2">
                        {{$item->user->name}}
                    </span>
                    <p class="px-2">
                        {{$item->content}}
                    </p>
                </a>
            @empty
                <span class="text-center font-semibold">Nenhum sweet encontrado</span>
            @endforelse
        @endif
    </div>
</div>
