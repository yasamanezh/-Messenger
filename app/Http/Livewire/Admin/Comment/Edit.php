<?php

namespace App\Http\Livewire\Admin\Comment;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Repositories\Contract\{
    ILog,
    IComment
};

class Edit extends Component {

    public $is_modle = false,$answer_id;
    protected $rules = [
        'comment.content' => 'required|string',
        'comment.answer' => 'required',
        'comment.email' => 'nullable|email',
        'comment.status' => 'nullable',
        'comment.name' => 'nullable',
        'comment.website' => 'nullable',
    ];

    public function createLog($data) {

        return app()->make(ILog::class)->create($data);
    }

    public function getInterface() {

        return app()->make(IComment::class);
    }

    public function mount($id) {
        $this->comment = $this->getInterface()->find($id);
        $answer = $this->getInterface()->getAnswer($id);
 
        if($answer){
          $this->comment->answer = $answer->content;  
          $this->is_modle = true;
          $this->answer_id = $answer->id;
        }
        
    }

    public function updateInfo() {
        if (Gate::allows('edit_comment')) {
            $this->validate();
            $comment = [
                'name' => $this->comment->name,
                'email' => $this->comment->email,
                'content' => $this->comment->content,
                'website' => $this->comment->website,
            ];
            $answer = ['content' => $this->comment->answer];
            $createAnswer = ['content' => $this->comment->answer,'parent_id'=> $this->comment->id,'status'=>1];
            $this->getInterface()->update($this->comment->id,$comment);
            if ($this->is_modle) {
                $this->getInterface()->update($this->answer_id,$answer);
            } else {
                $this->getInterface()->create($createAnswer);
            }
            $this->createLog([
                'user_id' => auth()->user()->id,
                'url' => 'answer comment',
                'actionType' => 'comments'
            ]);
            
            return (redirect(route('admin.comments')))->with('sucsess', 'success !');
        } else {
            $this->emit('toast', 'warning', 'permission denied !');
        }
    }

    public function render() {
        return view('livewire.admin.comment.edit')->layout('layouts.admin');
    }

}
