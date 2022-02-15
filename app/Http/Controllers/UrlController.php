<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UrlController extends Controller
{

    // TODO shortening of the url
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
        ]);

        $url = new Url();
        $url->original_url = $request->url;
        $url->shortened_url = $request->url;
        $url->save();

        $shortURL = $request->url;

        return redirect('view-url')->with('shortUrl',$shortURL);

    }

    public function view(){
        return view('view_url');
    }

}
