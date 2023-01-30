<?php

namespace App\Http\Livewire\Admin\Role;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;

use App\Repositories\Contract\{
    ILog,
    IRole
};

class Add extends Component {

    public $name, $label;
    public $edits = [];
    public $shows = [];
    public $delets = [];
    public $SelectShow = false;
    public $SelectEdit = false;
    public $SelectDelete = false;

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getInterface() {

        return app()->make(IRole::class);
    }

    public function UpdatedSelectShow($value) {
        $this->shows = $this->getInterface()->UpdatedSelectShow($value, 'show');
    }

    public function UpdatedSelectEdit($value) {

        $this->edits = $this->getInterface()->UpdatedSelectShow($value, 'edit');
    }

    public function UpdatedSelectDelete($value) {

        $this->delets = $this->getInterface()->UpdatedSelectShow($value, 'delete');
    }

    protected $rules = [
        'name' => 'required|string|min:2|max:255',
        'label' => 'required',
    ];

    public function saveInfo() {
        if (Gate::allows('edit_role')) {
            $edits = $this->edits;
            $shows = $this->shows;
            $delets = $this->delets;
            $this->validate();
            $data =['name'=> $this->name,'label'=> $this->label];
            $role = $this->getInterface()->create($data);

            $this->getInterface()->attachPermission($role, $edits);
            $this->getInterface()->attachPermission($role, $shows);
            $this->getInterface()->attachPermission($role, $delets);
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'create ' . 'role',
                'url' => $this->name,
            ]);

            return redirect(route('admin.roles'))->with('sucsess', 'success !');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function render() {

        $showPermissions = $this->getInterface()->getPermission('show');
        $editPermissions = $this->getInterface()->getPermission('edit');
        $deletePermissions = $this->getInterface()->getPermission('delete');

        return view('livewire.admin.role.add', compact('showPermissions', 'editPermissions', 'deletePermissions'))->layout('layouts.admin');
    }

}
