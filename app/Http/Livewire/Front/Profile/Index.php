<?php

namespace App\Http\Livewire\Front\Profile;

use Livewire\Component;

class Index extends Component {

    public $multiLanguage = false;

    public function mount($language = null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
    }

    public function render() {
        return view('livewire.front.profile.index');
    }

}
