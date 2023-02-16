<?php

namespace App\Http\Livewire\Admin\Module;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Image;
use App\Repositories\Contract\{
    ILog,
    IModule
};
use Livewire\WithFileUploads;

class About extends Component {

    use WithFileUploads;

    public $module_id, $description, $uploadImage, $image, $title, $short_content, $languages, $more_text, $more_link;
    public $typePage = 'posts';
    protected $rules = [
        "description" => "required|array|min:1",
        "description.en" => "required|string|min:3",
        "title" => "required|array|min:1",
        "title.en" => "required|string|min:3",
        "short_content.en" => "required|string|min:3",
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function uploadImage() {
        $directory = "public/photos/modules";
        $name = $this->uploadImage->getClientOriginalName();
        Image::make($this->uploadImage->getRealPath())->resize(557, 575)->save();
        $this->uploadImage->storeAs($directory, $name);
        return("photos/modules/" . "$name");
    }

    public function getCurrentTitle() {

        return $this->getInterface()->getCurrentTitle($this->post_id);
    }

    public function getItems() {

        if ($this->uploadImage) {
            return [
                'type' => 'about',
                'more_link' => $this->more_link,
                'file1' => $this->uploadImage(),
            ];
        } else {
            return [
                'type' => 'about',
                'more_link' => $this->more_link,
            ];
        }
    }

    public function mount() {

        if (!Gate::allows('show_design')) {
            abort(403);
        }
        $data = $this->getInterface()->firstByType('about');

        if ($data) {
            $this->image = $data->file1;
            $this->module_id = $data->id;
            $this->more_link = $data->more_link;
        }
        $this->languages = $this->getInterface()->getLanguage();



        foreach ($this->languages as $value) {
            $this->title[$value->language->code] = '';
            $this->description[$value->language->code] = '';
            $this->short_content[$value->language->code] = '';
            $this->more_text[$value->language->code] = '';

            $code = $data->translate()->where('language_id', $value->language->id)->first();
          
            if ($code) {
                $this->title[$value->language->code] = $code->title;
                $this->description[$value->language->code] = $code->content;
                $this->short_content[$value->language->code] = $code->short_content;
                $this->more_text[$value->language->code] = json_decode($code->meta,true)['more_text'];
               
            }
        }
    }

    public function getTranslate() {

        $translations = [];
        foreach ($this->languages as $lan) {
            $title = '';
            $content = '';
            $short='';
            


            $this->title[$lan->language->code] ? $title = $this->title[$lan->language->code] : $title = '';
            $this->description[$lan->language->code] ? $content = $this->description[$lan->language->code] : $content = '';

            if ($this->short_content && $this->short_content[$lan->language->code]) {
                $short = $this->short_content[$lan->language->code];
            }
            if ($this->more_text && $this->more_text[$lan->language->code]) {
                $more = json_encode(['more_text'=>$this->more_text[$lan->language->code]]);
            }else{
               $more = ''; 
            }

            if (!empty($title) || !empty($content) || !empty($more) || !empty($short)) {
               if($more){
                   $translations[] = [
                    'title' => $title,
                    'short_content' => $short,
                    'content' => $content,
                    'meta' => $more,
                    'language_id' => $lan->language->id
                ];
               }else{
                  $translations[] = [
                    'title' => $title,
                    'short_content' => $short,
                    'content' => $content,
                    'language_id' => $lan->language->id
                ]; 
               }
                
            }
        }
        return $translations;
    }

    public function saveInfo() {
        if (Gate::allows('edit_module')) {
            $this->validate();

            if ($this->uploadImage) {
                $this->validate([
                    'uploadImage' => 'required|image',
                ]);
            }
            $translates = $this->getTranslate();
            $items = $this->getItems();

            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'edit ' . $this->typePage,
                'url' => $this->typePage,
            ]);

            $this->getInterface()->update($this->module_id, $items, $translates);
            return (redirect(route('admin.modules')))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function getInterface() {

        return app()->make(IModule::class);
    }

    public function render() {

        return view('livewire.admin.module.about')->layout('layouts.admin');
    }

}
