<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\View\View;


use Outhebox\LaravelTranslations\Models\Language;
use Outhebox\LaravelTranslations\Models\Phrase;
use Outhebox\LaravelTranslations\Models\Translation;

class DahboardController extends Controller
{
public function __construct()
    {
       
    }

    public function index(): View
    {
 
        $languages_installed =Language::count();
        return view('index', compact('languages_installed'));
    }



   
}
