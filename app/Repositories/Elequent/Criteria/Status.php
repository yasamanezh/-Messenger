<?php

namespace App\Repositories\Elequent\Criteria; 

class Status {
    
    public function apply($model,$type,$value) {
        return  $model->where($type,$value);
    }
}
