<?php

namespace App\Http\Livewire\Admin\Language;

use Livewire\Component;
use App\Repositories\Contract\ITranslation;
use App\Models\Phrase;
use Illuminate\Support\Facades\Gate;

class Edit extends Component {

    public $phara, $name, $lang_id;

    public function getInterface() {
        return app()->make(ITranslation::class);
    }

    public function mount($id) {
        if (!Gate::allows('show_language')) {
             abort(403); 
        } 
        $this->phara = Phrase::pluck('value', 'id')->toArray();
        $ids = Phrase::pluck('id')->toArray();
        $lang = $this->getInterface()->findLanguags($id);


        if (!$lang) {
            abort(404);
        }
        $this->lang_id = $lang->translation->id;
        $this->name = $lang->id;
        $code = $lang->code;

        if (file_exists(base_path('lang/' . $code . '.json'))) {
            $jsonfile = file_get_contents(base_path('lang/' . $code . '.json'));
            $values = json_decode($jsonfile, true);
            foreach ($values as $key => $value) {
                $item = Phrase::where('value', $key)->first();
                if ($item) {
                    $this->phara[$item->id] = $value;
                }
            }
        }
    }

    public function saveInfo() {
        if (Gate::allows('edit_language')) {
            $this->validate([
                'name' => 'required'
            ]);
            $array = [
                'language_id' => $this->name,
            ];
            app()->make(ITranslation::class)->update($this->lang_id, $array);

            $phara = $this->phara;
            $keys = $this->phara = Phrase::pluck('value')->toArray();
            $code = $this->getInterface()->findLanguags($this->name)->code;
            $data = array_combine($keys, $phara);


            file_put_contents(base_path('lang/' . $code . '.json'), json_encode($data, JSON_FORCE_OBJECT));

            return redirect(route('admin.language'))->with('sucsess', 'sucsess !');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function render() {
        $languages = $this->getInterface()->getLanguags();
        $pharas = Phrase::get();

        return view('livewire.admin.language.edit', compact('languages', 'pharas'))->layout('layouts.admin');
    }

}
