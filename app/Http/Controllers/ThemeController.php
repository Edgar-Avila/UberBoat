<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function toggleTheme(Request $request) {
        $theme = $request->cookie('theme');
        $newTheme = $theme === 'dark' ? 'light' : 'dark';
        return redirect()->back()->cookie('theme', $newTheme);
    }
}
