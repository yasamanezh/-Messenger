<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Translation;
use App\Models\Language;
use App\Models\Setting;

class setfactor {

    public function handle(Request $request, Closure $next) {
        $local = $request->segment(1);
        
            $Translations = Translation::with('language')->get();
            $languages = [];
            foreach ($Translations as $key => $value) {
                array_push($languages, $value->language->code);
            }

            $setting = Setting::first();
            $deounltLanguageID = Language::findOrFail($setting->daf_lang);

            if (in_array($local, $languages)) {
                app()->setLocale($local);
            } else {
                app()->setLocale($deounltLanguageID->code);
            }
            return $next($request);
        
    }

}
