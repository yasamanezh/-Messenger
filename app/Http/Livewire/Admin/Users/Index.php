<?php

namespace App\Http\Livewire\Admin\Users;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\IUser;
use App\Repositories\Contract\ILog;

class Index extends Component {

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public $search;
    public $state = [];
    public $count_data = 10;
    public $IdBeingRemoved = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $mulitiSelect = [];
    public $readyToLoad = false;
    public $SelectPage = false;
    public $typePage = 'users';

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getUserName() {

        return $this->getInterface()->getUserName($this->IdBeingRemoved);
    }

    public function getInterface() {

        return app()->make(IUser::class);
    }

    public function UpdatedSelectPage($value) {
        $param = ['name', $this->search, $this->count_data];
        $this->mulitiSelect = $this->getInterface()->UpdatedSelectPage($value, $param);
    }

    public function confirmRemoval($categoryId) {
        $this->IdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function confirmAllRemoval() {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll() {
        if (Gate::allows('delete_user')) {
            $this->getInterface()->deleteAll($this->mulitiSelect);
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'Mass deletion',
                'url' => $this->typePage,
            ]);
            $this->mulitiSelect = [];
            $this->SelectPage = false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success', 'success !');
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function delete() {
        if (Gate::allows('delete_user')) {
            $name = $this->getInterface()->getUserName($this->IdBeingRemoved);

            $this->getInterface()->delete($this->IdBeingRemoved);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'delete ' . $this->typePage,
                'url' => $name,
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'success !');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function cancelDelete() {

        $this->dispatchBrowserEvent('hide-delete-modal');
    }

    public function cancellAllDelete() {

        $this->dispatchBrowserEvent('hide-form');
    }

    public function changeStatus($id) {

        $this->getInterface()->chanseStatus($id);

        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'change Status ' . $this->typePage,
            'url' => $this->getUserName($this->IdBeingRemoved),
        ]);
        $this->emit('toast', 'success', 'success !');
    }

    public function sortBy($columnName) {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection() {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function loadPage() {

        $this->readyToLoad = true;
    }

    public function changeRole(User $user, $role) {

        if (Gate::allows('edit_user')) {

            Validator::make(['role' => $role], [
                'role' => ['required', Rule::in(User::ROLE_ADMIN, User::ROLE_USER, User::ROLE_EMPLOYEE)],
            ])->validate();
            $this->getInterface()->update($user->id, ['role' => $role]);

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'change Role ' . $this->typePage,
                'url' => $user->name,
            ]);

            $this->emit('toast', 'success', 'success !');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function export() {
        if (Gate::allows('edit_user')) {
            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'export ' . $this->typePage,
                'url' => 'users',
            ]);
            return (new UsersExport())->download('users.xlsx');
        } else {
            $this->emit('toast', 'warning', 'permission denied!');
        }
    }

    public function render() {

        $data_info = $this->readyToLoad ? $this->getInterface()->all('name', $this->search)
                        ->orderBy($this->sortColumnName, $this->sortDirection)
                        ->latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.users.index', compact('data_info', 'deleteItem'))->layout('layouts.admin');
    }

}
