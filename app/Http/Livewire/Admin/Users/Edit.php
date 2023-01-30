<?php

namespace App\Http\Livewire\Admin\Users;

use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Repositories\Contract\{IUser,ILog,IRole};
use Livewire\Component;
use \App\Models\User;

class Edit extends Component
{

    public $user,$name, $email, $password,$password_confirmation,  $role, $AdminRoles = [];

    public function mount(User $user) {
   
        $this->role  = $user->role;
        $this->name  = $user->name;
        $this->email = $user->email;
        $this->user  = $user;
 
        if($this->user->roles){
            foreach ($this->user->roles as $key=>$value){
                array_push($this->AdminRoles,$value->id);
            }
        }

    }
    
    public function createLog($data) {
        
        return  app()->make(ILog::class)->create($data);
    }

    public function getInterface() {

        return  app()->make(IUser::class);

    }
   
    protected $rules = [
        'name'     => 'required|string|min:3',
    ];
    
    public function getData() {
        
        
        if($this->password){
            return [
            'name'     => $this->name,
            'email'    => $this->email,
            'role'     => $this->role ,
            'status'   => '1' ,
            'password' => bcrypt($this->password),
        ];
            
        }else{
             return [
            'name'     => $this->name,
            'email'    => $this->email,
            'role'     => $this->role ,
            'status'   => '1' ,
        ];
        }
    }

    public function saveInfo() {
        
        if (Gate::allows('edit_user')) {
            $this->validate();
            $this->validate([
            'email' => ['required', 'email',Rule::unique('users')->ignore($this->user->id)],
            ]);
            
            if ($this->role == 'Employee') {
                $this->validate([ 'AdminRoles' => 'required|array|min:1']);
            }
            
            $data = $this->getData();
            

             $item =$this->getInterface()->update($this->user->id,$data);
             
            
             
            if ($this->role === 'Employee') {
                $this->getInterface()->updateRole($this->user->id,$this->AdminRoles);
    
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
     
        return view('livewire.admin.users.edit',compact('roles'))->layout('layouts.admin');
    }
}
