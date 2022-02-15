<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UrlResource;
use App\Models\Url;

class UrlApiController extends Controller
{

    public function allUrls()
    {
        return new UrlResource(Url::all());
    }

}
