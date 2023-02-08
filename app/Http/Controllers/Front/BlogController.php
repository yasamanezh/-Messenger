<?php

namespace App\Http\Controllers\Front;

use App\Repositories\Contract\iBlog;
use App\Http\Controllers\Controller;

class BlogController extends Controller {

    public function index($lang=null) {

        $posts = app()->make(iBlog::class)->activePosts();
        dd($lang);
        return view('front.blog.index', compact('blog'));
    }

    public function category($language =null, $id) {

        //$posts = app()->make(iBlog::class)->activePosts();
        dd($language);
        return view('front.blog.index', compact('blog'));
    }

}
