<?php

namespace App\Http\Livewire\Front\Page;

use Livewire\Component;
use App\Traits\{
    Page,
    Translate
};
use App\Repositories\Contract\{
    ISetting,
    IContact
};

class Contact extends Component {

    use Page;
    use Translate;

    public $page, $title, $name, $email, $phone_number, $msg_subject, $message, $success;

    public function mount($language = null) {

        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $this->page = $this->getPage('contact');
        if (!$this->page) {
            abort(404);
        }
        $this->seo($this->page);
    }

    public function save() {
        $this->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'phone_number' => 'required|string|min:2',
            'msg_subject' => 'required|string|min:2',
            'message' => 'required|string|min:2',
        ]);
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'msg_subject' => $this->msg_subject,
            'message' => $this->message,
        ];

        $this->getContactInterface()->create($data);
        $this->reset(['name', 'email', 'phone_number', 'msg_subject', 'message']);
        $this->success = 'success !';
    }

    public function getContactInterface() {
        return app()->make(IContact::class);
    }

    public function render() {
        $setting = app()->make(ISetting::class)->first();
        $call_text = $this->getTranslate('call_text', $this->page, 'true');
        return view('livewire.front.page.contact', compact('call_text', 'setting'))->layout('layouts.front');
    }

}
