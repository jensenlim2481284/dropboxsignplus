<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Translate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranslateController extends Controller
{

    # Translate page
    public function index(Request $request){
       
        $translates = new Translate;
        if( $query = $request->input('query'))
            $translates = $translates->where('key', 'like', '%'.$query.'%')->orWhere('value_en', 'like', '%'.$query.'%')->orWhere('value_zh_CN', 'like', '%'.$query.'%');
        $translates = $translates->orderBy('created_at','desc')->paginate(30);

        return view('pages.dashboard.translate', compact('translates'));
    }

    # Update translate
    public function update(Request $request){
        Translate::find(customDecryption($request->id))->update($request->all());
        return 1;
    }

}
