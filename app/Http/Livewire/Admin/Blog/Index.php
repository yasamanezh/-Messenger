<?php

namespace App\Http\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\iBlog;
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\Settinges;

class Index extends Component {

    use WithPagination;
    use Settinges;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'blog';
    public $editeroute = 'admin.blog.edit';
    public $typePage = 'Blog Category';
    
    public function mount() {
         if (!Gate::allows('show_blog')) {
             abort(403); 
        } 
    }

    public function getInterface() {

        return app()->make(iBlog::class);
    }

    public function render(iBlog $blog) {

        $datas = $this->readyToLoad ? $blog->all($this->search)
                        ->orderBy($this->sortColumnName, $this->sortDirection)
                        ->paginate($this->count_data) : [];

        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.blog.index', compact('deleteItem', 'datas'))->layout('layouts.admin');
    }

}
