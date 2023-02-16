<?php

namespace App\Http\Livewire\Admin\Language;

use Livewire\Component;
use App\Repositories\Contract\ITranslation;
use App\Models\Phrase;
use Illuminate\Support\Facades\Gate;

class Add extends Component {

    public $phara, $name;

    public function getInterface() {
        return app()->make(ITranslation::class);
    }

    public function mount() {
        if (!Gate::allows('show_language')) {
             abort(403); 
        }
        $this->phara = Phrase::pluck('value', 'id')->toArray();
    }

    public function saveInfo() {
        if (Gate::allows('edit_language')) {
            $this->validate([
                'name' => 'required'
            ]);
            $array = [
                'language_id' => $this->name,
                'source' => 0
            ];
            app()->make(ITranslation::class)->create($array);
            $phara = $this->phara;
            $keys = Phrase::pluck('value')->toArray();
            $code = $this->getInterface()->findLanguags($this->name)->code;

            $data = array_combine($keys, $phara);


            if (file_exists(base_path('lang/' . $code . '.json'))) {
                file_put_contents(base_path('lang/' . $code . '.json'), json_encode($data, JSON_FORCE_OBJECT));

                return redirect(route('admin.language'))->with('sucsess', 'sucsess !');
            }

            file_put_contents(base_path('lang/' . $code . '.json'), json_encode($data, JSON_FORCE_OBJECT));
            return redirect(route('admin.language'))->with('sucsess', 'sucsess !');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function render() {

        $languages = $this->getInterface()->getLanguags();
        $pharas = Phrase::get();

        return view('livewire.admin.language.add', compact('languages', 'pharas'))->layout('layouts.admin');
    }

}
