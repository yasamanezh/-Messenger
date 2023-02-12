<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Repositories\Contract\{
    IFaq,
    IHelp
};
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Traits\Admin\CreateSettinges;
use Illuminate\Support\Facades\Gate;

class Add extends Component {

    use WithFileUploads;
    use CreateSettinges;

    public $status, $category, $short_content, $title, $languages;
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
        "title.en" => "required|string|min:3",
    ];

    public function getItems() {
        return [
            'status' => $this->status,
            'help_id' => $this->category,
        ];
    }

    public function mount() {
        $this->status = 1;
        if (!Gate::allows('show_faq')) {
            abort(403);
        }
        $this->starterDate($this->Translateparams);
    }

    public function getInterface() {

        return app()->make(IFaq::class);
    }

    public function render() {
        $categories = app()->make(IHelp::class)->get();

        return view('livewire.admin.faq.add', compact('categories'))->layout('layouts.admin');
    }

}
