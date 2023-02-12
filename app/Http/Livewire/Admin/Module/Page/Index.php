<?php

namespace App\Http\Livewire\Admin\Module\Page;

use Livewire\Component;
use App\Repositories\Contract\IPage;
use App\Traits\Admin\Settinges;
use Illuminate\Support\Facades\Gate;

class Index extends Component {

    use Settinges;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'page';
    public $typePage = 'counter module';
    public $editeroute = 'admin.module.counter.edit';

    public function mount() {
        if (!Gate::allows('show_page')) {
            abort(403);
        }
    }

    public function getInterface() {

        return app()->make(IPage::class);
    }

    public function render(IPage $page) {

        $pages = $page->all()->get();
        return view('livewire.admin.module.page.index', compact('pages'))->layout('layouts.admin');
    }

}
