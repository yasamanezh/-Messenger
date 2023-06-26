<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IMenu;
use App\Models\Menu;
use App\Models\Translate;
use App\Repositories\Elequent\BaseRepository;

class MenuRepository extends BaseRepository implements IMenu {
    
    public function model() {
        
        return Menu::class;        
    }
    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }
    public function Menus($ids) {
        return $this->getModelClass()->where('status',1)->whereIn('id',$ids)->
                where('show_in_footer',1)->get(); 
    }
}
