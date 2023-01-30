<?php

namespace App\Http\Livewire\Admin\Users;


use Illuminate\Support\Facades\Gate;
use App\Repositories\Contract\{IUser,ILog,IRole};

use Livewire\Component;


class Add extends Component
{

    public $name, $email, $password,$password_confirmation,  $role, $AdminRoles = [];

    public function mount() {
        $this->role = 'user';
    }
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }

    public function getInterface() {

        return  app()->make(IUser::class);

    }
    protected $rules = [
        'name'     => 'required|string|min:3',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ];

    public function saveInfo() {
        if (Gate::allows('edit_user')) {

            $this->validate();
            
            if ($this->role == 'Employee') {
                $this->validate([ 'AdminRoles' => 'required|array|min:1']);
            }
            
            $data = [
                'name'     => $this->name,
                'email'    => $this->email,
                'role'     => $this->role ,
                'status'   => '1' ,
                'password' => bcrypt($this->password),
            ];
            

             $item =$this->getInterface()->create($data);
             
            if ($this->role === 'Employee') {
                $this->getInterface()->saveRole($item,$this->AdminRoles);
    
            }
            $this->createLog([
                'user_id'     => auth()->user()->id, 
                'actionType'  => 'create '. 'user', 
                'url'         => $this->name, 
            ]);
            return redirect(route('admin.users'))->with('sucsess', 'success  !');

        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }

    }

    public function render()  {
        $roles =  app()->make(IRole::class)->all('id','')->get();
        
        return view('livewire.admin.users.add', compact('roles'))->layout('layouts.admin');
    }
}
