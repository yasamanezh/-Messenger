<?php

namespace App\Http\Livewire\Admin\NewsLatter;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\{
    INews
};
use Illuminate\Support\Facades\Gate;
use App\Traits\Admin\General;

class Index extends Component {

    use WithPagination;
    use General;

    public $email;
    public $success = false;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'newsletter';
    public $typePage = 'newsletter';

    public function mount() {
        if (!Gate::allows('show_newsletter')) {
            abort(403);
        }
    }

    public function save() {
        if (Gate::allows('edit_newsletter')) {
            $this->validate([
                'email' => 'required|email'
            ]);
            $data = ['email' => $this->email];
            $this->getInterface()->create($data);
            $this->reset('email');
            $this->success = 'success!';
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function getInterface() {

        return app()->make(INews::class);
    }

    public function render() {

        $contacts = $this->readyToLoad ? $this->getInterface()->getEmail($this->search, $this->sortColumnName, $this->sortDirection, $this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.news-latter.index', compact('deleteItem', 'contacts'))->layout('layouts.admin');
    }

}
