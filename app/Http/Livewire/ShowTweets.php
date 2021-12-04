<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{

    use WithPagination;

    public $content = '';
    public $buttonSub = 'Create';
    public $act = "create";
    public $idEdit = null;
    public $token = null;
    public $user;

    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

    protected $listeners = [
        'delete'
    ];

    public function mount( $slug = null)
    {
        if ($slug) {
            $this->user = User::where('sluguser', $slug)->firstOrFail();
        }
    }

    public function render()
    {

        $tweets = new Tweet;
        if ($this->user) {
            $tweets = $tweets->where('user_id', $this->user->id);
        }
        $tweets = $tweets->latest()->paginate(5);
        return view('livewire.show-tweets', compact('tweets'));
    }

    public function create(){

        $this->validate();
        auth()->user()->tweets()->create([
            'content' => trim($this->content, "\n")
        ]);

        $this->dispatchBrowserEvent('swal:actionDid', [
            'title' => 'Criado com sucesso!',
            'type' => 'success',
            'text' => 'Sweet criado com sucesso'
        ]);

        $this->content = '';
    }

    public function delete( Tweet $tweet ){
        try {
            $tweet->delete();
            $this->createDispatcher( 'Excluído com sucesso!', 'success', 'Sweet excluído com sucesso' );
        } catch (\Throwable $th) {
            $this->createDispatcher( 'Falha ao excluir!', 'fail', 'Não foi possível excluir o Sweet, tente novamente.' );
        }
    }

    public function deleteConfirm( Tweet $tweet ){
        $this->dispatchBrowserEvent(
            'swal:confirm', [
                'type'=>'warning',
                'title'=>'Excluir Sweet?',
                'text'=>"Você tem certeza que deseja excluir o sweet?",
                'id'=>$tweet->id
            ]
        );
    }

    public function edit( Tweet $tweet ){


        if( $this->idEdit == $tweet->id ){
            return $this->cancelUpdate();
        }

        $this->idEdit = $tweet->id;
        $this->content = $tweet->content;
        $this->buttonSub = 'Editar';
        $this->act = "update({$tweet})";
        $this->resetErrors();
    }

    public function update( Tweet $tweet ){

        $this->validate();
        try {
            $tweet->update([
                'content' => $this->content
            ]);

            $this->content = '';
            $this->buttonSub = 'Create';
            $this->act = "create";
            $this->idEdit = null;

            $this->createDispatcher( 'Editado com sucesso!', 'success', 'Sweet editado com sucesso!' );
            $this->resetErrors();
        } catch (\Throwable $th) {
            //throw $th;
            $this->createDispatcher( 'Falha ao editar!', 'fail', 'Não foi possível editar o Sweet, tente novamente.' );
        }
    }

    public function like(Tweet $tweet){
        $tweet->likes()->create([
            'user_id' => auth()->id(),
            'tweet_id' => $tweet->id
        ]);
        $this->undeslike($tweet);

    }

    public function unlike(Tweet $tweet){
        $tweet->likes()
            ->where('user_id', auth()->id())
            ->forceDelete();
    }

    public function deslike(Tweet $tweet){
        $tweet->deslikes()->create([
            'user_id' => auth()->id(),
            'tweet_id' => $tweet->id
        ]);
        $this->unlike($tweet);
    }

    public function undeslike(Tweet $tweet){
        $tweet->deslikes()
            ->where('user_id', auth()->id())
            ->forceDelete();
    }


    public function cancelUpdate(){

        $this->content = '';
        $this->buttonSub = 'Create';
        $this->act = "create";
        $this->idEdit = null;

        $this->resetErrors();
    }

    // utils
    public function createDispatcher( ...$dispatchers ){
        $this->dispatchBrowserEvent('swal:actionDid', [
            'title' => $dispatchers[0],
            'type' => $dispatchers[1],
            'text' => $dispatchers[2]
        ]);
    }

    public function resetErrors(){
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
