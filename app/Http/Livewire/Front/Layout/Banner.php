<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Repositories\Contract\ISetting;
class Banner extends Component
{
    public function render()
    {
        $setting = app()->make(ISetting::class)->first();
        return view('livewire.front.layout.banner',compact('setting'));
    }
}
