<?php

namespace App\Http\Livewire\Front\Profile;

use Livewire\Component;
use App\Repositories\Contract\IUser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Index extends Component {

    public $multiLanguage = false;
    public $user, $name, $email, $success, $errorsmsg;
    public $password_confirmation, $password;

    public function mount($language = null) {
        $this->success = false;
        $this->errorsmsg = false;
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->user = $this->getInterFace()->find(auth()->user()->id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function getInterFace() {
        return app()->make(IUser::class);
    }

    public function saveProfile() {

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)]
        ]);
        $this->success = false;
        $this->errorsmsg = false;

        if ($this->password) {
            $this->validate([
                'password' => 'required|string|min:8|max:20|confirmed',
            ]);
            
            $password = Hash::make($this->password);
        } else {
            $password = $this->user->password;
        }

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
        ];
        $this->getInterFace()->update($this->user->id, $data);

        $this->success = 'success!';
    }

    public function render() {
        return view('livewire.front.profile.index');
    }

}
