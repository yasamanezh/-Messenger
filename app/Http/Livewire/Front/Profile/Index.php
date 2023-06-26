<?php

namespace App\Http\Livewire\Front\Profile;

use Livewire\Component;
use App\Repositories\Contract\IUser;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Index extends Component {

    use WithFileUploads;
    public $multiLanguage = false;
    public $user, $name, $email, $success, $errorsmsg ,$uploadImage, $image;
    public  $password;

    public function mount($language = null) {
        $this->success = false;
        $this->errorsmsg = false;
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->user = $this->getInterFace()->find(auth()->user()->id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->image = $this->user->profile_photo_path;
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
         
            'password' => [  'string','min:8','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/']
     
                ],[
            'password'=>'The password must be 8 characters long and contain uppercase and lowercase letters numbers and symbols.'
            
            ]);
            
            $password = Hash::make($this->password);
        } else {
            $password = $this->user->password;
        }

       
        if ($this->uploadImage) {
            $this->validate([
            'uploadImage' => ['image', 'max:120'],
        ]);
             $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
            'profile_photo_path' => $this->uploadImage(),
        ];
             
        } else {
             $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
        ];
        }
        $this->getInterFace()->update($this->user->id, $data);

        $this->success = 'success!';
    }
    public function uploadImage() {
        $directory = "public/photos/profiles";
        $name = $this->uploadImage->getClientOriginalName();
        $this->uploadImage->storeAs($directory, $name);
        return("photos/profiles/" . "$name");
    }
    public function render() {
        return view('livewire.front.profile.index');
    }

}
