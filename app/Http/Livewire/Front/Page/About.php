<?php

namespace App\Http\Livewire\Front\Page;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};
use App\Repositories\Contract\ISetting;

class About extends Component {

    use Page;
    use Translate;

    public $page, $title;

    public function mount($language = null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage('about');
        if (!$this->page) {
            abort(404);
        }
        $this->seo($this->page);
    }

    public function render() {
        $setting = app()->make(ISetting::class)->first();
        return view('livewire.front.page.about', compact('setting'))->layout('layouts.front');
    }

}
