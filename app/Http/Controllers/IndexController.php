<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    # Index page 
    public function index()
    {

        return view('pages.index');
    }



    # Sign page 
    public function sign()
    {

        
        # Create embedded signature request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.hellosign.com/v3/signature_request/create_embedded');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $post = array(
            'client_id' => env('CLIENT_ID'),
            'file_urls' => [
                "https://www.dropbox.com/s/ad9qnhbrjjn64tu/mutual-NDA-example.pdf?dl=1"
            ],
            'title' => 'NDA with Acme Co.',
            'subject' => 'The NDA we talked about',
            'message' => 'Please sign this NDA and then we can discuss more. Let me know if you have any questions.',
            'signers[0][email_address]' => 'lim2481284@gmail.com',
            'signers[0][name]' => 'Jack',
            'signers[0][order]' => '0',
            'cc_email_addresses[]' => 'lim2481284@gmail.com',
            'signing_options[draw]' => '1',
            'signing_options[type]' => '1',
            'signing_options[upload]' => '1',
            'signing_options[phone]' => '1',
            'signing_options[default_type]' => 'draw',
            'test_mode' => '1'
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_USERPWD, env('API_KEY') . ':' . '');

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $url = null;
            return view('pages.sign', compact('url'));
            dd("Something went wrong - Create embedded signature request");
        }
        
        curl_close($ch);
        $result = json_decode($result);
        if(isset($result->error)){
            $url = null;
            return view('pages.sign', compact('url'));
            dd($result->error->error_msg);
        }
        $signatureID = $result->signature_request->signatures[0]->signature_id;

        # Get Embedded Sign URL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.hellosign.com/v3/embedded/sign_url/'.$signatureID);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_USERPWD, env('API_KEY') . ':' . '');
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $url = null;
            return view('pages.sign', compact('url'));
            dd("Something went wrong - Get Embedded Sign URL ");
        }
        curl_close($ch);
        $result = json_decode($result);
        $url = $result->embedded->sign_url;

        $url = "https://app.hellosign.com/editor/embeddedSign?signature_id=802379436e4664f7615f21b5426f9000&token=97075e7dd557e7b8f3a9a5ee7eb505c2";
        return view('pages.sign', compact('url'));
    }


    # Report page 
    public function report()
    {
        $track = Track::latest()->first();
        $gaze = json_decode($track->gaze);
        $time = json_decode($track->time);
        $totalTime = array_sum($time); 

        return view('pages.report', compact('time','totalTime','gaze'));
    }


}
