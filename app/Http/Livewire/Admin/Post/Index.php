<?php

namespace App\Http\Livewire\Admin\Post;


use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\{iBlog,IPost};
use App\Traits\Admin\Settinges;


class Index extends Component
{
    use WithPagination;
    use Settinges;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'post';
    public $editeroute = 'admin.post.edit';
    public $typePage = 'posts';
    

    public function mount() {
        if (!Gate::allows('show_post')) {
            abort(403);
        }
    }

    public function getInterface() {

        return  app()->make(IPost::class);

    }
    
    public function AllCategry() {

        return  app()->make(iBlog::class);

    }
    public function render(IPost $post) {

        $datas       = $this->readyToLoad ? $post->all($this->search)
                     -> orderBy($this->sortColumnName, $this->sortDirection)
                     -> paginate($this->count_data) : [];
        $categories  = $this->AllCategry()->all('')->get();

        $deleteItem  = $this->mulitiSelect;

        return view('livewire.admin.post.index',compact('deleteItem','datas','categories'))->layout('layouts.admin');
    }
}
