<?php

namespace App\Http\Livewire\Admin\Footer;

use Livewire\Component;
use App\Repositories\Contract\{
    IFooter,
    IMenu
};
use App\Models\Menu;
use App\Traits\Admin\UpdateSettinges;
use Illuminate\Support\Facades\Gate;

class Index extends Component {

    use UpdateSettinges;

    public $module_id, $content_right, $content_left, $title_right, $title_left, $Useful_Links_text, $company, $support, $languages;
    public $Company_links = [], $Support_links = [], $Useful = [];
    public $is_module = false;
    public $typePage = 'footer';
    public $Translateparams = [
        ['content_right',
            "content_left",
            'title_right',
            'title_left',
            'Useful_Links_text',
            'company',
            'support',
        ]
    ];
    public $IndexRoute = 'admin.footer';
    public $gate = 'design';
    protected $rules = [
        "content_right" => "nullable|array|min:1",
        "content_right.en" => "nullable|string|min:3",
        "content_left" => "nullable|array|min:1",
        "content_left.en" => "nullable|string|min:3",
        "title_right" => "nullable|array|min:1",
        "title_right.en" => "nullable|string|min:3",
        "title_left" => "nullable|array|min:1",
        "title_left.en" => "nullable|string|min:3",
        "Useful_Links_text" => "nullable|array|min:1",
        "Useful_Links_text.en" => "nullable|string|min:2",
        "company" => "nullable|array|min:1",
        "company.en" => "nullable|string|min:2",
        "support" => "nullable|array|min:1",
        "support.en" => "nullable|string|min:2",
    ];

    public function getItems() {
        return [
            'Company_links' => json_encode($this->Company_links),
            'Support_links' => json_encode($this->Support_links),
            'Useful_links' => json_encode($this->Useful),
        ];
    }

    public function mount() {
        if (!Gate::allows('show_design')) {
            abort(403);
        }
        $data = $this->getInterface()->first();
        $this->starterDate($data, $this->Translateparams);

        if ($data) {

            $this->module_id = $data->id;
            $this->Company_links = json_decode($data->Company_links);
            $this->Support_links = json_decode($data->Support_links);
            $this->Useful = json_decode($data->Useful_links);
        }
    }

    public function getInterface() {

        return app()->make(IFooter::class);
    }

    public function render(Imenu $menu) {
            $menus = Menu::where('show_in_footer','1')->get();

        return view('livewire.admin.footer.index', compact('menus'))->layout('layouts.admin');
    }

}
