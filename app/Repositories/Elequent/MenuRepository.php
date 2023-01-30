<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IMenu;
use App\Models\Menu;
use App\Repositories\Elequent\BaseRepository;

class MenuRepository extends BaseRepository implements IMenu {
    
    public function model() {
        
        return Menu::class;        
    }

}
