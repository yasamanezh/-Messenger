<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.module.index')->layout('layouts.admin');
    }
}
