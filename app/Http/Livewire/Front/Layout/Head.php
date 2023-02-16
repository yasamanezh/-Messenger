<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Models\Language;
use App\Repositories\Contract\ISetting;

class Head extends Component
{
    public function render()
    {
        $lang     = app()->getLocale();
        $directon = Language::where('code',$lang)->first();
        $directon->rtl ? $dir = 'rtl' : $dir = 'ltr';
        $setting =app()->make(ISetting::class)->first();
        
        return view('livewire.front.layout.head', compact('dir','setting'));
    }
}
