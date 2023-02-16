<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\INews;
use App\Models\NewsLetter;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class NewsRepository extends NoTranslateBaseRepository implements INews {

    public function model() {

        return NewsLetter::class;
    }

    public function getEmail($search, $sortColumnName, $sortDirection, $count_data) {
        return $this->getModelClass()->
                        where('email', 'LIKE', "%{$search}%")->
                        orWhere('id', $search)->
                        orderBy($sortColumnName, $sortDirection)->
                        latest()->paginate($count_data);
    }

    public function UpdatedCustomeSelectPage($value, $param) {

        if ($value) {
            $mulitiSelect = $this->getModelClass()->
            where('email', 'LIKE', "%{$param[0]}%")->
            orWhere('id', $param[0])->latest()->paginate($param[1])->pluck('id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $mulitiSelect = [];
        }
        return $mulitiSelect;
    }

}
