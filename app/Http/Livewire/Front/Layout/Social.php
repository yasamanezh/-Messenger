<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Repositories\Contract\ISocial;
use App\Helper\facade\EmailConfig;
class Social extends Component
{
    public function render()
    {
        EmailConfig::emailConfig();
                
        $social = app()->make(ISocial::class)->first();
        return view('livewire.front.layout.social', compact('social'));
    }
}
