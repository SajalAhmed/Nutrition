<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\RegisterUserInterface;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    private $registerUserInterface="";

    public function __construct(RegisterUserInterface $registerUserInterface) {
        $this->middleware(function ($request, $next) {
            \Session::put('top_menu',"register_user");
            \Session::put('sub_menu',"register_user");
            return $next($request);
        });
        $this->registerUserInterface = $registerUserInterface;
    }

    public function index()
    {
        checkPermission("register_user",VIEW);
        $data['divisions']=$this->registerUserInterface->getOnlyDivision();
        return view("admin.register_user.index",$data);
    }
    public function control()
    {
        checkPermission("register_user",PUBLISH);
        $user_id=\request()->input("user_id");
        $this->registerUserInterface->control($user_id);
        return redirect()->route("admin.registerUser");
    }
    public function delete()
    {
        checkPermission("register_user",DELETE);
        $user_id=\request()->input("user_id");
        $this->registerUserInterface->delete($user_id);
        return redirect()->route("admin.registerUser");
    }
    public function view(Request $request)
    {
        return $this->registerUserInterface->datatableViewRegisterUser($request);
    }
    public function details()
    {
        $id=\request()->input("id");
        $data['single']=$this->registerUserInterface->findById($id);
        // return $data['single'];
        $returnHTML = view('admin.register_user.user-details')->with($data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
    public function getOnlyDistrict()
    {
        $division_id=\request()->input("division_id");
        return $this->registerUserInterface->getOnlyDistrict($division_id);
    }
    public function getOnlyUpazilla()
    {
        $district_id=\request()->input("district_id");
        return $this->registerUserInterface->getOnlyUpazilla($district_id);
    }

}
