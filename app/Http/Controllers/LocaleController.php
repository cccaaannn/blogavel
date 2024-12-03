<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function changeLocale(Request $request)
    {
        $lang = $request->locale;

        if (!in_array($lang, ['en', 'tr'])) {
            abort(400);
        }

        Session::put('locale', $lang);

        return redirect()->back();
    }
}
