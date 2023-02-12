<?php

namespace App\Http\Livewire\Admin\Faq;

use Livewire\Component;
use App\Repositories\Contract\{
    IFaq,
    IHelp
};
use App\Traits\Admin\UpdateSettinges;
use Illuminate\Support\Facades\Gate;

class Edit extends Component {

    use UpdateSettinges;

    public $module_id, $short_content, $status, $title, $languages;
    public $typePage = 'faq';
    public $Translateparams = ['title', 'short_content'];
    public $IndexRoute = 'admin.faqs';
    public $gate = 'faq';
    protected $rules = [
        'category' => 'required|exists:helps,id',
        'status' => 'required|integer|min:0|max:1',
        "short_content" => "required|array|min:1",
        "short_content.en" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.*" => "required|string|min:3",
    ];

    public function getItems() {
        return [
            'status' => $this->status,
            'help_id' => $this->category,
        ];
    }

    public function mount($id) {
        if (!Gate::allows('show_faq')) {
            abort(403);
        }
        $data = $this->getInterface()->find($id);
        $this->starterDate($data, $this->Translateparams);
        if ($data) {
            $this->languages = $this->getInterface()->getLanguage();
            $this->status = $data->status;
            $this->module_id = $id;
            $this->category = $data->help_id;
        }
    }

    public function getInterface() {

        return app()->make(IFaq::class);
    }

    public function render() {
        $categories = app()->make(IHelp::class)->get();
        return view('livewire.admin.faq.edit', compact('categories'))->layout('layouts.admin');
    }

}
