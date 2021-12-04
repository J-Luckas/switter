<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use App\Models\User;
use Livewire\Component;

class SearchSite extends Component
{
    protected $listeners = [
                'search'=>'render',
            ];

    public $search = '';
    public $styleList = ["hidden", ""];

    public function render()
    {
        $retorno_lista = $this->searchRegisters();

        return view('livewire.search-site', compact('retorno_lista'));
    }

    public function searchRegisters()
    {
        if ($this->search == '') {
            $this->reset('styleList');
            return $users = '';
        }
        $this->styleList = ["flex", "rounded-b-none"];
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->get();

        $sweets = Tweet::where('content', 'like', '%' . $this->search . '%')
            ->get();

        return [$users, $sweets];
    }

}
