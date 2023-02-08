<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IPack;
use App\Models\{Pack,Option,Translate};
use App\Repositories\Elequent\BaseRepository;

class PackRepository extends BaseRepository implements IPack {
    
    public function model() {
        
        return Pack::class;        
    }   
    public function getOptions() {
        return app()->make($this->getOptionModel())->get();
    }
     public function getPackOptions($id) {
         $pack = $this->find($id);
        return $pack->options()->get();
    }
    
    public function getOptionModel() {
        return Option::class;
    }
    public function attachOption($id, $datas) {
        $pack = $this->find($id);
        $pack->options()->attach($datas);
    }
    public function syncOption($id, $datas) {
        $pack = $this->find($id);
        $pack->options()->sync($datas);
    }
    public function translationModel() {

        return Translate::class;
    }
    
    public function getPacks() {
        return $this->getModelClass()->where('status',1)->orderBy('sort')->get();
    }

    public function hasTranslation() {
        return true;
    }

}
