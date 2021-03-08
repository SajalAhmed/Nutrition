<?php

namespace App\Http\Controllers;

use App\Repository\DashboardInterface;
use App\Repository\RegisterUserInterface;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $dashboardInterface='';
    private $registerUserInterface='';

     public function __construct(DashboardInterface $dashboardInterface,RegisterUserInterface $registerUserInterface) {
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"dashboard");
            Session::put('sub_menu',"dashboard");
            return $next($request);
        });
        $this->dashboardInterface=$dashboardInterface;
        $this->registerUserInterface=$registerUserInterface;
    }
    public function index()
    {
        $data['divisions']=$this->registerUserInterface->getOnlyDivision();
        return view("admin.dashboard.dashboard",$data);
    }

    public function getAnalytics(Request $request)
    {
        $data=$this->dashboardInterface->getAnalytics($request);
        return response()->json($data);
    }
}
