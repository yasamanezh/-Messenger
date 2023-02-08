<?php

namespace App\Http\Livewire\Front\Page\Layout;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};

class Call extends Component {

    use Translate;
    use Page;

    public $title, $setting;

    public function mount($title) {
        $this->title = $title[1];
        $this->setting = $title[0];
    }

    public function render() {
        return view('livewire.front.page.layout.call');
    }

}
