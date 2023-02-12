<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IBase;
use Illuminate\Database\Eloquent\Builder;
use App\Models\{Language,Translation};
use Illuminate\Support\Facades\DB;


use Exception;

class BaseRepository implements IBase {

    protected $model;
    protected $translationModel ;
    public    $lang_id;
    public    $param = '';
    public    $haveTranslate = false;
   

    public function getModelClass() {

        if (!method_exists($this, 'model')) {
            throw new Exception('no modele exist ! ');
        }
        
        return app()->make($this->model());
    }

    public function __construct() {
        
        $this->model = $this->getModelClass();
        if($this->hasTranslation()){
            $this->haveTranslate  = true;
          $this->translationModel = app()->make($this->translationModel()); 
        }
    }

    public function currentLanquage() {
        
        $language = Language::where('code', app()->getLocale())->pluck('id')->first();
        return $language;
    }

    public function UpdatedSelectPage($value, $param) {

        if ($value) {
            $mulitiSelect = $this->all($param[0])->latest()->paginate($param[1])->pluck('translateable_id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $mulitiSelect = [];
        }
        return $mulitiSelect;
    }

    public function all($search='') {

        $Model = $this->model();
        $this->param = $search;
        return  $this->translationModel->with('translateable')->whereHasMorph('translateable', [$Model], function (Builder $query) {
                $query->where('language_id', $this->currentLanquage())
                ->where('title', 'LIKE', "%{$this->param}%");
            }
        );
    }
  
    public function chanseStatus($param) {

        $item = $this->getModelClass()->findOrFail($param);
        $item->status == 1 ? $status = 0 : $status = 1;
        $item->update([
            'status' => $status
        ]);
    }

    public function delete($id) {
        $item = $this->getModelClass()->with('translate')->findOrFail($id);
        $item->delete();
         foreach ($item->translate as $value){
            $value->delete();
        }
    }

    public function deleteAll($ids) {
        foreach ($ids as $id) {
            $item = $this->getModelClass()->with('translate')->findOrFail($id);
            $item->delete();
            foreach ($item->translate as $value){
                $value->delete();
            }
        }
    }

    public function create($data,$translate) {
        
        DB::beginTransaction();
            $item = $this->getModelClass()->create($data);
            $item->translate()->createMany($translate);
        DB::commit();
        return $item->id;
    }

    public function getLanguage() {
         $langs=Translation::with('language')->get();
         return $langs;
    }

    public function find($id) {
        
       return $this->getModelClass()->with('translate')->findOrFail($id);
    }
    
    public function findBySlug($slug) {
        
       return $this->getModelClass()->with('translate')->where('slug',$slug)->first();
    }
    
    public function first() {
        
       return $this->getModelClass()->with('translate')->first();
    }
     
   public function getCurrentTitle($id) {
      
       return $this->find($id)->currentTranslate()->title;
    
    }
   
    public function update($id,$data, $translate) {
            
        $item = $this->getModelClass()->find($id);
        $item ->update($data);
        foreach($translate as $value){
            $this->lang_id  =  $value['language_id'];
            $translateItem  =$item->translate()->where('language_id',$value['language_id'])->first();
            if($translateItem){
                $translateItem->update($value);
            } else {
                $item->translate()->create($value);
            }
            

        }
       
    }
    
    public function get() {
        return $this->getModelClass()->get();
    }
    
    public function getEnables() {
        return $this->getModelClass()->where('status',1)->get();
    }
    
    public function PaginateEnables($count,$slug =null) {
        if($slug){
            return $this->getModelClass()->where('status',1)->where('slug',$slug)->paginate($count);
        }
        else{
            return $this->getModelClass()->where('status',1)->paginate($count);
        }
    }
    
      public function takeByEnable($count) {
        return $this->getModelClass()->where('status',1)->take($count)->get();
    }
     
    

}
