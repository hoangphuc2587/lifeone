<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function download_file($user,$filename)
    {
        $url = public_path().'/uploads/'.$user.'/'.$filename;

        return response()->download($url);
    }
}
