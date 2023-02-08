<?php

namespace App\Http\Livewire\Admin\Module\Page;

use Livewire\Component;
use App\Repositories\Contract\IPage;
use App\Traits\Admin\Settinges;

class Index extends Component {

    use Settinges;

    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $gate = 'design';
    public $typePage = 'counter module';
    public $editeroute = 'admin.module.counter.edit';

    public function getInterface() {

        return app()->make(IPage::class);
    }

    public function render(IPage $page) {

        $pages = $page->all()->get();
        return view('livewire.admin.module.page.index', compact('pages'))->layout('layouts.admin');
    }
}
