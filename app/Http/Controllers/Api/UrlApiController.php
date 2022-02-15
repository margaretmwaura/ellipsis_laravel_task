<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlApiController extends Controller
{

    public function allUrls()
    {
        return new UrlResource(Url::all());
    }

    public function deleteUrl(Request $request){

        $id = $request->id;

        $url = Url::find($id);

        if(is_null($url)){

            return response()->json([
                'status' => 404,
                'message' => 'Url not found'
            ]);
        }

        $url->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Url was updated deleted'
        ]);
    }

}
