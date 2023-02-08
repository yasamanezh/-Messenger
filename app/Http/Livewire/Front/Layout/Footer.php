<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Models\Language;
use App\Repositories\Contract\IFooter;
use App\Traits\{

    Translate
};
class Footer extends Component
{
    use Translate;
    public $multiLanguage;
    public function mount($language ) {
        
        $this->multiLanguage = $language;
    }
    public function render()
    {
        $footer = app()->make(IFooter::class)->first();
        
        return view('livewire.front.layout.footer', compact('footer'));

    }
}
