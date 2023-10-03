<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    # Index page 
    public function index()
    {
        return view('pages.web.index');
    }

}
