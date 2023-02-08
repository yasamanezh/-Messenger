<?php

namespace App\Http\Livewire\Front\Post\Layout;

use Livewire\Component;
use App\Models\Comment as CommentModel;
use App\Repositories\Contract\IPost;
use Livewire\WithPagination;

class Comment extends Component {
    
use WithPagination;
    public $post, $website, $name, $email, $comment,$success;
   protected $paginationTheme = 'bootstrap';
    public function saveComment() {
        $this->validate([
            'name' => 'nullable|string|min:2|max:255',
            'email' => 'required|email',
            'website' => 'nullable|string|min:2|max:255',
            'comment' => 'required|string|min:3|max:65525',
        ]);

        CommentModel::create([
            'post_id' => $this->post->id,
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->comment,
            'website' => $this->website,
        ]);
        $this->emit('toast', 'success', 'success!');
        $this->success ='success!';
        $this->reset('name', 'email', 'comment', 'website');
    }
    
    public function answer($id) {
        return  app()->make(IPost::class)->answers($id);
    }

    public function mount($post) {
        
        $this->post = $post;
    }

    public function render() {
        
        $comments = app()->make(IPost::class)->comments($this->post->id,4);
      
        return view('livewire.front.post.layout.comment', compact('comments'));
    }

}
