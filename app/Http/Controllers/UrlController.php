<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
        ]);

        $shortURL = env('APP_URL') . '/' . Str::random(6);

        $originalUrl = $request->url;

        $url = new Url();
        $url->original_url = $request->url;
        $url->shortened_url = $shortURL;
        $url->save();


        return redirect('view-url')->with(['shortUrl' => $shortURL, 'originalUrl' => $originalUrl]);

    }

    public function view(){
        return view('view_url');
    }

}
