<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Models\Menu as MenuModels;

use App\Traits\Translate;

class Menu extends Component {
    
    use Translate;

       public $multiLanguage;

    public function haveChild($param) {
        $menus = MenuModels::where('parent', $param)->get();
        return $menus;
    }


    public function mount($lang) {
        $this->multiLanguage = $lang;
    }

   

    public function render() {
        
        $menus = MenuModels::where('parent', 0)->where('status',1)->get();
        return view('livewire.front.layout.menu', compact('menus'));
    }

}
