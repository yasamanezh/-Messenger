<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Outhebox\LaravelTranslations\Models\Language;
use Outhebox\LaravelTranslations\Models\Phrase;
use Outhebox\LaravelTranslations\Models\Translation;
class LanguageController extends Controller
{
       public function index()
    {
 
        $languages_installed =Language::count();
        return view('admin.index', compact('languages_installed'));
    }

    public function phrases(Translation $translation)
    {
        return view('admin.phrases', [
            'translation' => $translation,
        ]);
    }

    public function phrase(Translation $translation, Phrase $phrase)
    {
        
        return view('admin.phrase', [
            'phrase' => $phrase,
            'translation' => $translation,
        ]);
    }
}
