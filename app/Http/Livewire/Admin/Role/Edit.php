<?php

namespace App\Http\Livewire\Admin\Role;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Role;
use App\Repositories\Contract\{
    ILog,
    IRole
};

class Edit extends Component {

    public $name, $label, $role;
    public $edits = [];
    public $shows = [];
    public $delets = [];
    public $SelectShow = false;
    public $SelectEdit = false;
    public $SelectDelete = false;

    public function mount(Role $role) {
        if (!Gate::allows('show_role')) {
            abort(403);
        }
        $this->role = $role;
        $this->name = $role->name;
        $this->label = $role->label;

        foreach ($this->getInterface()->getRolePermission($role->id, 'show') as $show) {
            array_push($this->shows, $show->id);
        }
        foreach ($this->getInterface()->getRolePermission($role->id, 'edit') as $edit) {
            array_push($this->edits, $edit->id);
        }
        foreach ($this->getInterface()->getRolePermission($role->id, 'delete') as $delete) {
            array_push($this->delets, $delete->id);
        }
    }

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

            $permitions = array_merge($this->edits, $this->shows, $this->delets);

            $this->validate();
            $data = ['name' => $this->name, 'label' => $this->label];
            $this->getInterface()->update($this->role->id, $data);

            $this->getInterface()->syncPermission($this->role->id, $permitions);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'edit role',
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

        return view('livewire.admin.role.edit', compact('showPermissions', 'editPermissions', 'deletePermissions'))->layout('layouts.admin');
    }

}
