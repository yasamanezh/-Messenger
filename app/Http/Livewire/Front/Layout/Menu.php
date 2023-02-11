<?php

namespace App\Http\Livewire\Front\Layout;

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
        $menus = MenuModels::where('parent', $param)->get();
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
        } elseif ($type == 'post') {
            $post = app()->make(IPost::class)->find($param->slug);

            if ($this->multiLanguage) {
                $menuRoute = ['front.post.language', [ 'language'=>app()->getLocale(),'id'=>$post->slug]];
            } else {
                $menuRoute = ['front.post', $post->slug];
            }
        } elseif ($type == 'page') {
            $page = app()->make(IPage::class)->find($param->slug);
            if ($this->multiLanguage) {
                $menuRoute = ['front.page.language',[ 'language'=>app()->getLocale(),'id'=>$page->slug]];
            } else {
                $menuRoute = ['front.page', $page->slug];
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
        return str_replace(app()->getlocale(), $param, Request::url());
    }

    public function mount($lang) {

        $this->multiLanguage = $lang;
        $this->setting = app()->make(ISetting::class)->first();
        $this->defaultLanguage = Language::findOrFail($this->setting->daf_lang);

        $this->translations = Translation::get();
    }

    public function render() {

        $menus = MenuModels::where('parent', 0)->where('status', 1)->get();
        return view('livewire.front.layout.menu', compact('menus'));
    }

}
