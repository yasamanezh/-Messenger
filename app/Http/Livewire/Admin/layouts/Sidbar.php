<?php

namespace App\Http\Livewire\admin\layouts;


use Livewire\Component;
use App\Repositories\Contract\ISetting;

class Sidbar extends Component
{
    public function render()
    {      $setting   = app()->make(ISetting::class)->first();  
        return view('livewire.admin.layouts.sidbar',compact('setting'));
    }
}
