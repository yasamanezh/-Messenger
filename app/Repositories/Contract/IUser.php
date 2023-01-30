<?php

namespace App\Repositories\Contract;

interface IUser {
    public function getUserName($id);
    public function updateRole($id,$roles);
    public function saveRole($id,$roles);
}
