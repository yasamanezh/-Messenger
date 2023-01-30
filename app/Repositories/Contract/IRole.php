<?php

namespace App\Repositories\Contract;

interface IRole {
    
    public function getPermission($param);
    public function UpdatedSelectShow($value,$label);
    public function attachPermission($id, $datas);
    public function getRolePermission($id,$param);
    public function syncPermission($id, $datas);
   
}
