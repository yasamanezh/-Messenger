<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Models\Language;

class Head extends Component
{
    public function render()
    {
        $lang     = app()->getLocale();
        $directon = Language::where('code',$lang)->first();
        $directon->rtl ? $dir = 'rtl' : $dir = 'ltr';
        
        return view('livewire.front.layout.head', compact('dir'));
    }
}
