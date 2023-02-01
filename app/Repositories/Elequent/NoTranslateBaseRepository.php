<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\INoTranslateBase;

use App\Models\Language;


use Exception;

class NoTranslateBaseRepository implements INoTranslateBase {

    protected $model;
    public    $lang_id;
    public    $param = '';

    public function getModelClass() {

        if (!method_exists($this, 'model')) {
            throw new Exception('no modele exist ! ');
        }
        
        return app()->make($this->model());
    }

    public function __construct() {
        
        $this->model = $this->getModelClass();
    }

    public function currentLanquage() {
        
        $language = Language::where('code', app()->getLocale())->pluck('id')->first();
        return $language;
    }

    public function UpdatedSelectPage($value, $param) {

        if ($value) {
            $mulitiSelect = $this->all($param[0],$param[1])->latest()->paginate($param[2])->pluck('id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $mulitiSelect = [];
        }
        return $mulitiSelect;
    }

    public function all($field,$search) {
 
        return $this->getModelClass()->where("$field", 'LIKE', "%{$search}%");
    }

    public function chanseStatus($param) {

        $item = $this->getModelClass()->findOrFail($param);
        $item->status == 1 ? $status = 0 : $status = 1;
        $item->update([
            'status' => $status
        ]);
    }

    public function delete($id) {
        $item = $this->getModelClass()->findOrFail($id);
        $item->delete();
        
    }

    public function deleteAll($ids) {
        foreach ($ids as $id) {
            $item = $this->getModelClass()->findOrFail($id);
            $item->delete();
        }
    }

    public function create($data) {
        $item = $this->getModelClass()->create($data);
        return $item->id;
    }

    public function find($id) {
        
       return $this->getModelClass()->findOrFail($id);
    }
    
     public function first() {
        
       return $this->getModelClass()->first();
    }

    public function update($id,$data) {            
        $item = $this->getModelClass()->find($id);
        $item ->update($data); 
        return $item->id;
        
    }

    public function search($arrays, $search) {
        $query   = where('id', 'LIKE', "%{$search}%");
         if(!empty($array)) {
           foreach ($arrays as $array)
            $query = $query  .'->'.orWhere($array, 'LIKE', "%{$search}%");
       }
       return $query;
       
    }

}
