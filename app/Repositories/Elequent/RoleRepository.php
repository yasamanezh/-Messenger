<?php

namespace App\Repositories\Elequent;

use App\Repositories\Contract\IRole;
use App\Models\Role;
use App\Models\Permission;
use App\Repositories\Elequent\NoTranslateBaseRepository;

class RoleRepository extends NoTranslateBaseRepository implements IRole {

    public function model() {

        return Role::class;
    }

    public function getPermission($param) {
        return app()->make($this->getPermissionModel())->where('label', $param)->get();
    }
     public function getRolePermission($id,$param) {
         $role = $this->find($id);
        return $role->permissions()->where('label',$param)->get();
    }
    
    

    public function getPermissionModel() {
        return Permission::class;
    }

    public function UpdatedSelectShow($value, $label) {
        if ($value) {
            $shows = app()->make($this->getPermissionModel())->where('label', $label)
            ->latest()->get()->pluck('id')->map(fn($item) => (string) $item)->toArray();
        } else {
            $shows = [];
        }
        return $shows;
    }

    public function attachPermission($id, $datas) {
        $role = $this->find($id);
        $role->permissions()->attach($datas);
    }
    public function syncPermission($id, $datas) {
        $role = $this->find($id);
        $role->permissions()->sync($datas);
    }

}
