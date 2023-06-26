<?php

namespace App\Traits\Admin;

use App\Repositories\Contract\{
    ILog,
    IModule
};
use Illuminate\Support\Facades\Gate;

trait UpdateModule {

    public function __construct() {
        $this->languages = $this->getInterface()->getLanguage();
    }

    public function getInterface() {

        return app()->make(IModule::class);
    }

    public function starterDate($data, $params) {

        foreach ($this->languages as $value) {
            foreach ($params as $param) {
                if (is_array($param)) {
                    foreach ($param as $value1) {
                        $this->$value1[$value->language->code] = '';
                    }
                } else {
                    $this->$param[$value->language->code] = '';
                }
            }
        }
        if ($data) {
            foreach ($this->languages as $value) {
                $code = $data->translate()->where('language_id', $value->language->id)->first();
                if ($code) {
                    foreach ($params as $param) {
                        if (is_array($param)) {
                            foreach ($param as $value1) {
                                $meta = json_decode($code->meta, true);
                                if ($meta && isset($meta[$value1])) {
                                    $this->$value1[$value->language->code] = $meta[$value1];
                                }
                            }
                        } else {
                            $this->$param[$value->language->code] = $code->$param;
                        }
                    }
                }
            }
        }
    }

    public function getTranslate($params) {
        $translations = [];
        foreach ($this->languages as $lan) {
            $items = [];
            $meta = [];
            $is_meta = false;
            foreach ($params as $param) {
                if (is_array($param)) {
                    $is_meta = true;
                    foreach ($param as $value) {
                        if ($this->$value[$lan->language->code] && !empty($this->$value[$lan->language->code])) {
                            $meta[$value] = $this->$value[$lan->language->code];
                        }
                    }
                } elseif ($this->$param[$lan->language->code]) {
                    if (!empty($this->$param[$lan->language->code])) {
                        $items[$param] = $this->$param[$lan->language->code];
                    }
                }
            }

            $lang = ['language_id' => $lan->language->id];

            if ($is_meta) {
                $more = ['meta' => json_encode($meta)];
                $is_value = false;
                foreach($items as $item){
                    if(!empty($item)){
                        $is_value =true;
                    }
                }
                if($is_value){
                    $translations[] =array_merge($items, $lang, $more);
                }else{
                  $translations[] =array_merge($lang, $more);  
                }
                
            } else {
                $is_value = false;
                foreach($items as $item){
                    if(!empty($item)){
                        $is_value =true;
                    }
                }
                if($is_value){
                    $translations[] = array_merge($items, $lang);
                }
                
            }
        }
        return $translations;
    }

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function saveData() {

        $translates = $this->getTranslate($this->Translateparams);

        $items = $this->getItems();
        if ($this->is_module) {
            $this->getInterface()->update($this->module_id, $items, $translates);
            if ($this->typePage == 'screen module' || $this->typePage == 'top page module') {
                $this->deleteOldImage();
                $this->getInterface()->updateImage($this->module_id, $this->saveImage());
            }
        } else {
            $this->getInterface()->create($items, $translates);
            if ($this->typePage == 'screen module') {
                $this->getInterface()->updateImage($id, $this->saveImage());
            }
        }

        $this->createLog([
            'user_id' => auth()->user()->id,
            'actionType' => 'update ' . $this->typePage,
            'url' => $this->typePage,
        ]);
    }

    public $descript = [];

    public function saveInfo() {

        if (Gate::allows('edit_' . $this->gate)) {
            $this->validate();
            $this->saveData();
            return (redirect(route($this->IndexRoute)))->with('sucsess', 'sucsess');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

}
