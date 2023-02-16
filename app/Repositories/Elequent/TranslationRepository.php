<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\ITranslation;
use App\Models\{Translation,Language};
use App\Repositories\Elequent\NoTranslateBaseRepository;

class TranslationRepository extends NoTranslateBaseRepository implements ITranslation {

    public $serach;

    public function model() {

        return Translation::class;
    }
    public function Languagemodel() {

        return Language::class;
    }
    
    public function getLanguags() {
        return app()->make($this->Languagemodel())->get();
        
    }
    
    public function findLanguags($id) {
        return app()->make($this->Languagemodel())->find($id);
        
    }
    
    

    public function getTranslation($search, $sortColumnName, $sortDirection, $count_data) {
        $this->serach = $search;

        return $this->getModelClass()->
                        where('source', '<>', '1')->
                        when($this->serach, function ($query) {
                            $query->whereHas('language', function ($query) {
                                $query->where('name', 'like', "%{$this->serach}%")
                                ->orWhere('code', 'like', "%{$this->serach}%");
                            });
                        })->orderBy($sortColumnName, $sortDirection)
                        ->latest()->paginate($count_data);
        ;
    }

    public function UpdatedCustomeSelectPage($value, $param) {
        $this->serach = $param[0];
        if ($value) {
            $mulitiSelect = $this->getModelClass()->
            where('source', '<>', '1')->
            when($this->serach, function ($query) {
            $query->whereHas('language', function ($query) {
            $query->where('name', 'like', "%{$this->serach}%")
            ->orWhere('code', 'like', "%{$this->serach}%");
            });
            })->latest()->paginate($param[1])->pluck('id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $mulitiSelect = [];
        }
        return $mulitiSelect;
    }

}
