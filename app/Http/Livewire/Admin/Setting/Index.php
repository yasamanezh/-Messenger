<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Repositories\Contract\ISetting;
use App\Traits\Admin\UpdateSettinges;
use Illuminate\Support\Facades\Gate;


class Index extends Component {

    use WithFileUploads;
    use UpdateSettinges;

    public $module_id,$meta_keyword, $meta_title, $meta_description, $languages,$content;
    public $data = [], $uploadLogo, $uploadIcon,$success=false;
    public $typePage = 'setting';
    public $Translateparams  =['content','meta_keyword','meta_title','meta_description'];
    public $IndexRoute       = 'admin.setting';
    public $gate             ='design';
    protected $rules = [
        'data.logo'           => 'nullable',
        'data.email1'           => 'nullable',
        'data.email2'           => 'nullable',
        'data.phone1'           => 'nullable',
        'data.phone2'           => 'nullable',
        'data.address'           => 'nullable',
        'data.icon'           => 'nullable',
        'uploadLogo'          => 'nullable|image',
        'uploadIcon'          => 'nullable|image',
        'data.location'       => 'nullable|string',
        'data.daf_lang'       => 'required|exists:ltu_languages,id',
        'data.mail_parameter' => 'nullable|string',
        'data.mail_username'  => 'nullable|string',
        'data.mail_password'  => 'nullable|string',
        "meta_keyword"        => "nullable|array|min:1",
        "meta_keyword.en"      => "nullable|string|min:3",
        "meta_title"          => "nullable|array|min:1",
        "meta_title.en"        => "nullable|string|min:3",
        "meta_description"    => "nullable|array|min:1",
        "meta_description.en"  => "nullable|string|min:3",
    ];

  
    public function getItems() {

        $this->uploadLogo ? $logo = $this->uploadImage($this->uploadLogo) : $logo = $this->data['logo'];
        $this->uploadIcon ? $icon = $this->uploadImage($this->uploadIcon) : $icon = $this->data['icon'];

        return [
            'logo' => $logo,
            'icon' => $icon,
            'phone1' => $this->data['phone1'],
            'phone2' => $this->data['phone2'],
            'email1' => $this->data['email1'],
            'email2' => $this->data['email2'],
            'location' => $this->data['location'],
            'daf_lang' => $this->data['daf_lang'],
            'mail_parameter' => $this->data['mail_parameter'],
            'mail_username' => $this->data['mail_username'],
            'mail_password' => $this->data['mail_password'],
        ];
    }

    public function mount() {
        if (!Gate::allows('show_setting')) {
            abort(403);
        }
        $data = $this->getInterface()->first();
        
        $this->starterDate($data, $this->Translateparams);
        $this->data = [
            'id' => '',
            'logo' => '',
            'icon' => '',
            'location' => '',
            'email1' => '',
            'email2' => '',
            'phone1' => '',
            'phone2' => '',
            'daf_lang' => '',
            'mail_parameter' => '',
            'mail_username' => '',
            'mail_password' => '',
        ];

        if ($data) {
            $this->data      = $data;
            $this->module_id = $data->id;
        }
        

    }
    
    public function uploadImage($img) {

        $directory = "public/photos/setting";
        $name = $img->getClientOriginalName();
        $img->storeAs($directory, $name);
        return("photos/setting/" . "$name");
    }

    public function getInterface() {

        return app()->make(ISetting::class);
    }

    public function render() {
        return view('livewire.admin.setting.index')->layout('layouts.admin');
    }

}
