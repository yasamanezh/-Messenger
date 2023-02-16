<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IPhrase;
use App\Models\Phrase;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class PhraseRepository extends NoTranslateBaseRepository implements IPhrase {

    public function model() {

        return Phrase::class;
    }

    public function getPhrase($search, $sortColumnName, $sortDirection, $count_data) {
        return $this->getModelClass()->
                        where('value', 'LIKE', "%{$search}%")->
                        orWhere('key', 'LIKE', "%{$search}%")->

                        orWhere('id', $search)->
                        orderBy($sortColumnName, $sortDirection)->
                        latest()->paginate($count_data);
    }

    public function UpdatedCustomeSelectPage($value, $param) {

        if ($value) {
            $mulitiSelect = $this->getModelClass()->
            where('value', 'LIKE', "%{$param[0]}%")->
            orWhere('key', 'LIKE', "%{$param[0]}%")->
            orWhere('id', $param[0])->latest()->paginate($param[1])->pluck('id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $mulitiSelect = [];
        }
        return $mulitiSelect;
    }

}
