<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIController extends Controller
{

    # Callback Handler
    public function callback(Request $request)
    {
        return response()->json(['success' => 'Hello API Event Received'], 200);
    }

    # Track Result Handler
    public function track(Request $request)
    {
        Track::create([
            'gaze' => $request->gaze,
            'time' => $request->time
        ]);
        return response()->json(['success' => 'success'], 200);
    }

}
