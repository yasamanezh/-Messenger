<?php

namespace App\Http\Livewire\Admin\Social;

use App\Repositories\Contract\{
    ILog,
    ISocial
};
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Index extends Component {

    public $social, $telegram, $whatsapp, $twitter, $linkdin, $instagram, $email, $success = false;

    public function mount() {
        $this->social = $this->getInterface()->first();

        if ($this->social) {
            $this->telegram = $this->social->telegram;
            $this->whatsapp = $this->social->whatsapp;
            $this->twitter = $this->social->twitter;
            $this->linkdin = $this->social->linkdin;
            $this->instagram = $this->social->instagram;
            $this->email = $this->social->email;
        }
    }

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getInterface() {

        return app()->make(ISocial::class);
    }

    public function saveInfo() {
        $this->success = false;
        if (Gate::allows('edit_option')) {
            $data = [
                'telegram' => $this->telegram,
                'whatsapp' => $this->whatsapp,
                'twitter' => $this->twitter,
                'linkdin' => $this->linkdin,
                'instagram' => $this->instagram,
                'email' => $this->email,
            ];
            if ($this->social) {
                $this->getInterface()->update($this->social->id, $data);
            } else {

                $this->getInterface()->create($data);
            }


            $this->createLog([
                'user_id' => auth()->user()->id,
                'actionType' => 'edit social',
                'url' => 'socials',
            ]);
            $this->success = 'success !';
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function render() {


        return view('livewire.admin.social.index')->layout('layouts.admin');
    }

}