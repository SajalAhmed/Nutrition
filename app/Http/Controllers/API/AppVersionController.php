<?php

namespace App\Http\Controllers\API;

use App\Models\AppVersion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppVersionResource;

class AppVersionController extends Controller
{
    public function index()
    {
        $data=new AppVersionResource(AppVersion::first());
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['App Version'],
            'data'=>$data
        ],200);
    }
}
