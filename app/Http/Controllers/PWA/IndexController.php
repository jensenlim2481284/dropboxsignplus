<?php

namespace App\Http\Controllers\PWA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    # Index page 
    public function index()
    {
        return view('pages.pwa.index');
    }

}
