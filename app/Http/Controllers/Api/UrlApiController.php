<?php

namespace App\Http\Controllers;

use App\Http\Resources\UrlResource;
use App\Models\Url;

class UrlApiController extends Controller
{

    public function allUrls()
    {
        return new UrlResource(Url::all());
    }

}
