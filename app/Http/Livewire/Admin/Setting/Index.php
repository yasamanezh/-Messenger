<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Repositories\Contract\{
    ILog,
    ISetting
};

class Index extends Component {

    use WithFileUploads;

    public $meta_keyword, $meta_title, $meta_description, $languages, $data = [], $uploadLogo, $uploadIcon,$success=false;
    public $typePage = 'Setting';
    protected $rules = [
        'data.logo'           => 'nullable',
        'data.icon'           => 'nullable',
        'uploadLogo'          => 'nullable|image',
        'uploadIcon'          => 'nullable|image',
        'data.location'       => 'nullable|string',
        'data.daf_lang'       => 'required|exists:ltu_languages,id',
        'data.mail_parameter' => 'nullable|string',
        'data.mail_username'  => 'nullable|string',
        'data.mail_password'  => 'nullable|string',
        "meta_keyword"        => "required|array|min:1",
        "meta_keyword.en"      => "required|string|min:3",
        "meta_title"          => "required|array|min:1",
        "meta_title.en"        => "required|string|min:3",
        "meta_description"    => "required|array|min:1",
        "meta_description.en"  => "required|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getCurrentTitle() {

        return $this->getInterface()->getCurrentTitle($this->blog_id);
    }

    public function getItems() {

        $this->uploadLogo ? $logo = $this->uploadImage($this->uploadLogo) : $logo = $this->data['logo'];
        $this->uploadIcon ? $icon = $this->uploadImage($this->uploadIcon) : $icon = $this->data['icon'];

        return [
            'logo' => $logo,
            'icon' => $icon,
            'location' => $this->data['location'],
            'daf_lang' => $this->data['daf_lang'],
            'mail_parameter' => $this->data['mail_parameter'],
            'mail_username' => $this->data['mail_username'],
            'mail_password' => $this->data['mail_password'],
        ];
    }

    public function mount() {

        $this->data = [
            'id' => '',
            'logo' => '',
            'icon' => '',
            'location' => '',
            'daf_lang' => '',
            'mail_parameter' => '',
            'mail_username' => '',
            'mail_password' => '',
        ];

        $data = $this->getInterface()->first();
        if ($data) {
            $this->data = $data;
        }


        $this->languages = $this->getInterface()->getLanguage();

        foreach ($this->languages as $value) {
            $this->meta_title[$value->language->code] = '';
            $this->meta_keyword[$value->language->code] = '';
            $this->meta_description[$value->language->code] = '';
            if ($data) {
                $code = $data->translate()->where('language_id', $value->language->id)->first();
                if ($code) {
                    $this->meta_title[$value->language->code] = $code->meta_title;
                    $this->meta_keyword[$value->language->code] = $code->meta_keyword;
                    $this->meta_description[$value->language->code] = $code->meta_description;
                }
            }
        }
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {
            $meta_title = '';
            $meta_keyword = '';
            $meta_description = '';

            if ($this->meta_title && $this->meta_title[$lan->language->code]) {
                $meta_title = $this->meta_title[$lan->language->code];
            }
            if ($this->meta_keyword && $this->meta_keyword[$lan->language->code]) {
                $meta_keyword = $this->meta_keyword[$lan->language->code];
            }
            if ($this->meta_description && $this->meta_description[$lan->language->code]) {
                $meta_description = $this->meta_description[$lan->language->code];
            }

            $translations[] = [
                'meta_title' => $meta_title,
                'meta_keyword' => $meta_keyword,
                'meta_description' => $meta_description,
                'language_id' => $lan->id
            ];
        }
        return $translations;
    }

    public function saveInfo() {
        $this->success = false;
        $this->validate();

        $translates = $this->getTranslate();
        $items = $this->getItems();

        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'edit ' . $this->typePage,
            'url' => 'settings',
        ]);
        if ($this->data['id']) {
            $this->getInterface()->update($this->data->id, $items, $translates);
        } else {
            $this->getInterface()->create($items, $translates);
        }

        $this->success = 'success !';
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
