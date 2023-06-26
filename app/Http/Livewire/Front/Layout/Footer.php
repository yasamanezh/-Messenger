<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Models\{Language,Translation};
use App\Repositories\Contract\{IFooter,ISetting,ISocial,IMenu,IPage,iBlog,IPost};
use Illuminate\Support\Facades\Request;
use App\Traits\{

    Translate
};

class Footer extends Component
{
    use Translate;
    public $multiLanguage,$Company_links,$Support_links,$Useful,$defaultLanguage,$setting,$email,$success,$translations;
    public function mount($language ) {
        
        $this->multiLanguage = $language;
        $this->lang = app()->getLocale();
        $this->setting = app()->make(ISetting::class)->first();
        $this->defaultLanguage = Language::findOrFail($this->setting->daf_lang);
        $this->translations = Translation::get();
    }
       public function getUrl($param) {
        $current_uri = request()->segments();
        if($this->multiLanguage){
            if (count($current_uri) == 1){
                return str_replace('/'.app()->getlocale(), '/'.$param, Request::url());
            }else{

                return str_replace('/'.app()->getlocale().'/', '/'.$param.'/', Request::url());
            }
        }else{
            if($_SERVER['REQUEST_URI'] != '/'){
                return str_replace($_SERVER['REQUEST_URI'],'/'.$param.$_SERVER['REQUEST_URI'],Request::url());
            }else{
               return Request::url().'/'.$param;
            }

        }

    }

     public function getHref($param) {


        $type = $param->type;
        $menuRoute = [0];
        if ($type == 'blog') {
            $blog = app()->make(iBlog::class)->find($param->slug);
            if ($this->multiLanguage) {
                $menuRoute = ['front.blog.language',[ 'language'=>app()->getLocale(),'id'=>$blog->slug]];
            } else {
                $menuRoute = ['front.blog', $blog->slug];
            }
        } elseif ($type == 'post') {
            $post = app()->make(IPost::class)->find($param->slug);

            if ($this->multiLanguage) {
                $menuRoute = ['front.post.language', [ 'language'=>app()->getLocale(),'id'=>$post->slug]];
            } else {
                $menuRoute = ['front.post', $post->slug];
            }
        } elseif ($type == 'page') {
            if($param->link ==1){
                 $menuRoute =[1,2,3,4];
            }else{
               $page = app()->make(IPage::class)->find($param->slug);
            if ($this->multiLanguage) {
                $menuRoute = ['front.page.language',[ 'language'=>app()->getLocale(),'id'=>$page->slug]];
            } else {
                $menuRoute = ['front.page', $page->slug];
            } 
            }
        } elseif ($type == 'weblog') {
            if ($this->multiLanguage) {
                $menuRoute = ['front.blog.language',[ 'language'=>app()->getLocale()]];
            } else {
                $menuRoute = ['front.blog'];
            }
        } else {
            if ($this->multiLanguage) {
                $menuRoute = ['front.' . $type . '.language',[ 'language'=>app()->getLocale()]];
            } else {
                $menuRoute = ['front.' . $type];
            }
        }
        return $menuRoute;
    }

 
    public function saveEmail() {
        $this->validate([
            'email'=>'required|email'
        ]);
        $latter = new \App\Models\NewsLetter();
        $latter->email = $this->email;
        $latter->save();
        $this->reset('email');
        $this->success = 'success !';
        
        
    }
    
    public function render()
    {
        $footer = app()->make(IFooter::class)->first();
        $social = app()->make(ISocial ::class)->first();
        if ($footer) {
            $Company_links = json_decode($footer->Company_links);
            if($Company_links){
                $this->Company_links = app()->make(IMenu::class)->Menus($Company_links);
            }
          
            $Support_links = json_decode($footer->Support_links);
             if($Support_links){
                $this->Support_links = app()->make(IMenu::class)->Menus($Support_links);
            }
            
            $Useful        = json_decode($footer->Useful_links); 
             if($Useful){
                $this->Useful = app()->make(IMenu::class)->Menus($Useful);
            }
        }
        $user =auth()->user();

        return view('livewire.front.layout.footer', compact('footer','social','user'));

    }
}
