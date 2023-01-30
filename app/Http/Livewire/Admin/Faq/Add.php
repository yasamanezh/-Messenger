<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Repositories\Contract\{
    IFaq,
    ILog,
    IHelp
};
use Livewire\WithFileUploads;
use Livewire\Component;

class Add extends Component {

    use WithFileUploads;

    public $status, $category, $description, $title, $languages;
    public $typePage = 'faq';
    protected $rules = [
        'category' => 'required|exists:helps,id',
        'status' => 'required|integer|min:0|max:1',
        "description" => "required|array|min:1",
        "description.*" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.*" => "required|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {

            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';



            $translations[] = [
                'title' => $title,
                'content' => $title,
                'language_id' => $lan->language->id
            ];
        }
        return $translations;
    }

    public function getItems() {
        return [
            'status' => $this->status,
            'help_id' => $this->category,
        ];
    }

    public function saveInfo() {

        $this->validate();
        $translates = $this->getTranslate();
        $items = $this->getItems();

        $data = $this->getInterface()->create($items, $translates);

        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'create ' . $this->typePage,
            'url' => $this->getInterface()->getCurrentTitle($data),
        ]);
        return (redirect(route('admin.faqs')))->with('sucsess', 'sucsess');
    }

    public function mount() {
        $this->status = 1;
        $this->languages = $this->getInterface()->getLanguage();
        foreach ($this->languages as $value) {

            $this->title[$value->language->code] = '';
            $this->description[$value->language->code] = '';
        }
    }

    public function getInterface() {

        return app()->make(IFaq::class);
    }

    public function render() {
        $categories = app()->make(IHelp::class)->get();

        return view('livewire.admin.faq.add', compact('categories'))->layout('layouts.admin');
    }

}
