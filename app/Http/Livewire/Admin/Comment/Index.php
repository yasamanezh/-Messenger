<?php

namespace App\Http\Livewire\Admin\Comment;


use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{IComment,IPost};
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\General;

class Index extends Component {

    use WithPagination;
    use General;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'comment';
    public $typePage = 'comments';
    
    public function mount() {
         if (!Gate::allows('show_comment')) {
             abort(403); 
        } 
    }

    public function getInterface() {

        return app()->make(IComment::class);
    }
    public function getCurrentTitle($id) {
        
       return app()->make(IPost::class)->getCurrentTitle($id); 
    }


    public function render(IComment $comment)
    {

        $comments = $this->readyToLoad ? $comment->getcomment($this->search,$this->sortColumnName,$this->sortDirection,$this->count_data)
         : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.comment.index', compact('deleteItem', 'comments'))->layout('layouts.admin');
    }
}
