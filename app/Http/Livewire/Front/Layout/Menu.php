<?php

namespace App\Http\Livewire\Front\Layout;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Menu as MenuModels;
use App\Repositories\Contract\{
    ISetting
};
use App\Models\{
    Translation,
    Language
};
use App\Traits\Translate;
use Illuminate\Support\Facades\Request;
use App\Repositories\Contract\{
    iBlog,
    IPost,
    IPage
};

class Menu extends Component {

    use Translate;

    public $multiLanguage, $setting, $translations, $defaultLanguag;

    public function haveChild($param) {
        $menus = MenuModels::where('parent', $param) ->where('show_in_header',1)->get();
        return $menus;
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
        } else if ($type == 'post') {
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

    public function mount($lang) {
        $this->multiLanguage = $lang;
        $this->setting = app()->make(ISetting::class)->first();
        $this->defaultLanguage = Language::findOrFail($this->setting->daf_lang);

        $this->translations = Translation::get();
    }

    public function render() {

        $menus = MenuModels::where('parent', 0)
                ->where('status', 1)
                ->where('show_in_header',1)
                ->orderBy('sort')
                ->get();
        $user  =auth()->user();
        return view('livewire.front.layout.menu', compact('menus','user'));
    }

}