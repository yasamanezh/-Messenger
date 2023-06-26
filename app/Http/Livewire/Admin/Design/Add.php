<?php

namespace App\Http\Livewire\Admin\Design;

use Livewire\Component;

class Add extends Component
{
    public function render()
    {
        return view('livewire.admin.design.add')->layout('layouts.page');;
    }
}
