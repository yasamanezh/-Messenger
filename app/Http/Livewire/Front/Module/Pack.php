<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Repositories\Contract\{IPack,IOption};
use App\Traits\{Module,Cart};
use App\Helper\facade\GetApi;
use App\Models\Setting;

class Pack extends Component
{
    use Module;
    use Cart;
    public $setting,$multiLanguage;
    public $subError =false;
    public $packError =false;
    public function mount($setting) {
        $this->setting = $setting[1];
        $this->multiLanguage = $setting[0];
    }
    public function render()
    {
        $setting  =  Setting::first();
        $module = $this->getInterface()->firstByType('pack');
         $modules = app()->make(IOption::class)->getEnables();
         $packs  = app()->make(IPack::class)->takeByEnable(2);
        
        return view('livewire.front.module.pack', compact('modules','packs','module','setting'));
    }
}
