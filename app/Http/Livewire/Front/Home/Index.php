<?php

namespace App\Http\Livewire\Front\Home;

use Livewire\Component;
use App\Repositories\Contract\ISetting;
use App\Traits\Translate;

class Index extends Component {

    use Translate;

    public $multiLanguage = false;
    public $setting;

    public function mount($language = null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->setting = app()->make(ISetting::class)->first();
        $options = \App\Models\Setting::first();
        $this->seo($options);
    }

    public function render() {

        return view('livewire.front.home.index')->layout('layouts.front');
    }

}
