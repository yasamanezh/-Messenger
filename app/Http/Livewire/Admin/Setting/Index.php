<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Repositories\Contract\ISetting;
use App\Traits\Admin\UpdateSettinges;
use Illuminate\Support\Facades\Gate;
use Spatie\Sitemap\SitemapGenerator;
use Image;

class Index extends Component {

    use WithFileUploads;
    use UpdateSettinges;

    public $module_id,$is_payment,$payment_url, $title, $meta_keyword, $meta_title, $meta_description, $languages, $content;
    public $data = [], $uploadLogo, $uploadIcon, $success = false;
    public $typePage = 'setting';
    public $Translateparams = ['title', 'content', 'meta_keyword', 'meta_title', 'meta_description'];
    public $IndexRoute = 'admin.setting';
    public $gate = 'setting';
    protected $rules = [
        'data.logo' => 'nullable',
        'data.is_payment' => 'nullable',
        'data.payment_url' => 'nullable',
        'data.app_store_link' => 'nullable',
        'data.google_play_link' => 'nullable',
        'data.free_trial' => 'nullable',
        'data.app_link' => 'nullable',
        'data.email1' => 'nullable',
        'data.email2' => 'nullable',
        'data.phone1' => 'nullable',
        'data.phone2' => 'nullable',
        'data.address' => 'nullable',
        'data.icon' => 'nullable',
        'uploadLogo' => 'nullable|image',
        'uploadIcon' => 'nullable|image',
        'data.location' => 'nullable|string',
        'data.daf_lang' => 'required|exists:ltu_languages,id',
        'data.mail_parameter' => 'nullable|string',
        'data.mail_username' => 'nullable|string',
        'data.mail_password' => 'nullable|string',
        'data.mail_mailer' => 'nullable|string',
        'data.mail_host' => 'nullable|string',
        'data.mail_port' => 'nullable|string',
        'data.mail_encription' => 'nullable|string',
        "meta_keyword" => "required|array|min:1",
        "meta_keyword.en" => "required|string|min:3",
        "meta_title" => "required|array|min:1",
        "meta_title.en" => "required|string|min:3",
        "meta_description" => "required|array|min:1",
        "meta_description.en" => "required|string|min:3",
    ];

    public function updateSitMap() {
        $path = \Illuminate\Support\Facades\URL::to('/');
        SitemapGenerator::create($path)->writeToFile(public_path('siteMap.xml'));
        $this->success = 'success';
    }

    public function clearCash() {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        $this->success = 'success';
    }

    public function Cash() {
        \Illuminate\Support\Facades\Artisan::call('optimize');
        $this->success = 'success';
    }

    public function getItems() {

        $this->uploadLogo ? $logo = $this->uploadLogo() : $logo = $this->data['logo'];
        $this->uploadIcon ? $icon = $this->uploadImage($this->uploadIcon) : $icon = $this->data['icon'];

        return [
            'logo' => $logo,
            'payment_url'=>$this->data['payment_url'],
            'is_payment'=>$this->data['is_payment'],
            'icon' => $icon,
            'app_store_link' => $this->data['app_store_link'],
            'google_play_link' => $this->data['google_play_link'],
            'free_trial' => $this->data['free_trial'],
            'app_link' => $this->data['app_link'],
            'phone1' => $this->data['phone1'],
            'phone2' => $this->data['phone2'],
            'email1' => $this->data['email1'],
            'email2' => $this->data['email2'],
            'location' => $this->data['location'],
            'daf_lang' => $this->data['daf_lang'],
            'mail_parameter' => $this->data['mail_parameter'],
            'mail_username' => $this->data['mail_username'],
            'mail_password' => $this->data['mail_password'],
            'mail_mailer' => $this->data['mail_mailer'],
            'mail_host' => $this->data['mail_host'],
            'mail_port' => $this->data['mail_port'],
            'mail_encription' => $this->data['mail_encription'],
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
            'app_store_link' => '',
            'google_play_link' => '',
            'free_trial' => '',
            'app_link' => '',
            'location' => '',
            'email1' => '',
            'email2' => '',
            'phone1' => '',
            'phone2' => '',
            'daf_lang' => '',
            'mail_parameter' => '',
            'mail_username' => '',
            'mail_password' => '',
             'mail_mailer' =>'',
            'mail_host' =>'',
            'mail_port' =>'',
            'mail_encription' => '',
             'payment_url'=>'',
            'is_payment'=>0,
        ];

        if ($data) {
            $this->data = $data;
            $this->module_id = $data->id;
            
        }
    }

    public function uploadImage($img) {

        $directory = "public/photos/setting";
        $name = $img->getClientOriginalName();
        $img->storeAs($directory, $name);

        return("photos/setting/" . "$name");
    }  
    public function uploadLogo() {
        $directory = "public/photos/setting";
        $name = $this->uploadLogo->getClientOriginalName();
        Image::make($this->uploadLogo->getRealPath())->resize(138, 44)->save();
        $this->uploadLogo->storeAs($directory, $name);
        return("photos/setting/" . "$name");
    }

    public function getInterface() {

        return app()->make(ISetting::class);
    }

    public function render() {
        return view('livewire.admin.setting.index')->layout('layouts.admin');
    }

}
