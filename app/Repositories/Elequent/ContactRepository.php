<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IContact;
use App\Models\Contact;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class ContactRepository extends NoTranslateBaseRepository implements IContact {

    public function model() {

        return Contact::class;
    }

    public function getContact($search, $sortColumnName, $sortDirection, $count_data) {
        return $this->getModelClass()->
                        where('phone_number', 'LIKE', "%{$search}%")->
                        orWhere('name', 'LIKE', "%{$search}%")->
                        orWhere('email', 'LIKE', "%{$search}%")->
                        orWhere('msg_subject', 'LIKE', "%{$search}%")->
                        orWhere('id', $search)->
                        orderBy($sortColumnName, $sortDirection)->
                        latest()->paginate($count_data);
    }

    public function UpdatedCustomeSelectPage($value, $param) {

        if ($value) {
            $mulitiSelect = $this->getModelClass()->
            where('phone_number', 'LIKE', "%{$param[0]}%")->
            orWhere('name', 'LIKE', "%{$param[0]}%")->
            orWhere('email', 'LIKE', "%{$param[0]}%")->
            orWhere('msg_subject', 'LIKE', "%{$param[0]}%")->
            orWhere('id', $param[0])->latest()->paginate($param[1])->pluck('id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $mulitiSelect = [];
        }
        return $mulitiSelect;
    }

}
