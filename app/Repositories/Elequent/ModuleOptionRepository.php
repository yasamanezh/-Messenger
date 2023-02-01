<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IModuleOption;
use App\Models\{ModuleOption,Translate};
use App\Repositories\Elequent\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
class ModuleOptionRepository extends BaseRepository implements IModuleOption {
    
    
    public function firstByType($param) {
         return $this->getModelClass()->with('translate')->where('type',$param)->first();
    }
    public function getByType($param,$status=null) {
        if($status=null){
            return $this->getModelClass()->with('translate')->where('type',$param)->orderBy('sort')->get();
        }
         
        else{
            return $this->getModelClass()->with('translate')->where('type',$param)->where('status',1)->orderBy('sort')->get();
        }
       
    }
    
    
       public function skipTake($param,$skip,$take) {
        
          return $this->getModelClass()->with('translate')
                  ->where('type',$param)
                  ->where('status',1)
                  ->orderBy('sort')
                  ->skip($skip)
                  ->take($take)
                  ->get();
       
    }
    
     
        
    public function model() {
        
        return ModuleOption::class;        
    }
  
    public $param;
   
    
     public function getClient($search) {
        $Model = $this->model();
        $this->param = $search;
        
        return Translate::with('translateableClient')->whereHasMorph('translateable', [$Model], function (Builder $query) {
                $query->where('language_id', $this->currentLanquage())
                ->where('title', 'LIKE', "%{$this->param}%");
            }
        );
    }
    public function translationModel() {

        return Translate::class;
    }

    public function hasTranslation() {
        return true;
    }
}
