<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Repositories\Contract\ISocial;
class Social extends Component
{
    public function render()
    {
        $social = app()->make(ISocial::class)->first();
        return view('livewire.front.layout.social', compact('social'));
    }
}
