<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IModule;
use App\Models\{Module,Translate};

use App\Repositories\Elequent\BaseRepository;

class ModuleRepository extends BaseRepository implements IModule {
    
    
    public function firstByType($param) {
         return $this->getModelClass()->with('translate')->where('type',$param)->first();
    }
    
    public function getByType($param) {
         return $this->getModelClass()->with('translate')->where('type',$param)->get();
    }
    
        
    public function model() {
        
        return Module::class;        
    }
    
    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    } 
    public function updateImage($id,$images) {
        $item = $this->getModelClass()->find($id);
        $item->attach()->createMany($images);
        return $item->attach;
    }

   

}
