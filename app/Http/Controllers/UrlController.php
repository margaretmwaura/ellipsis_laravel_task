<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Url;
use AshAllenDesign\ShortURL\Classes\Builder;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{

    // TODO add a validator for the url
    public function store(Request $request)
    {
        $builder = new Builder();

        $shortURLObject = $builder->destinationUrl($request->url)->make();
        $shortURL = $shortURLObject->default_short_url;

        $url = new Url();
        $url->original_url = $request->title;
        $url->shortened_url = $shortURL;
        $url->user_id = Auth::user() ? Auth::user()->id : 0;
        $url->save();
        return redirect('add-blog-post-form')->with($shortURL);
    }

    public function view(){
        return view('view_url');
    }
}
