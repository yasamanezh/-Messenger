<?php

namespace App\Repositories\Elequent;
use App\Repositories\Contract\IUser;
use App\Models\User;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class UserRepository extends NoTranslateBaseRepository implements IUser {
    
    public function model() {
        
        return User::class;        
    }
    public function getUserName($id) {
        
       return $this->find($id)->name;
    }
    
    public function saveRole($id,$roles) {
        $user =$this->find($id);
        $user->roles()->attach($roles); 
    }
    
 public function updateRole($id,$roles) {
        $user =$this->find($id);
        $user->roles()->sync($roles); 
    }
    
}
