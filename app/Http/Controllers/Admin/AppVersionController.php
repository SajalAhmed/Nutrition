<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppVersion;
use Illuminate\Http\Request;

class AppVersionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \Session::put('top_menu',"app_version");
            \Session::put('sub_menu',"app_version");
            return $next($request);
        });
    }
    public function index()
    {
        $data['single']=AppVersion::first();
        return view("admin.app.index",$data);
    }
    public function add(Request $request)
    {
        $request->validate([
            'version_code' => 'required|numeric',
            'version_name' => 'required',
            'force_update' => 'required|boolean'
        ]);
        AppVersion::updateOrCreate(
            ["id"=>$request->id],
            ["version_code"=>$request->version_code,"version_name"=>$request->version_name,"force_update"=>$request->force_update]
        );
        // AppVersion::updateOrCreate(
        //     ["id"=>$request->id],
        //     ["version_code"=>$request->version_code,"version_name"=>$request->version_name,"force_update"=>$request->force_update]
        // );
        setMessage("message","success","Successfully Updated");
        return redirect()->route("admin.appVersion");
    }
}
