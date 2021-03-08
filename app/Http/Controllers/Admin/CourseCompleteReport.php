<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\CourseCompleteInterFace;
use App\Repository\RegisterUserInterface;
use Illuminate\Http\Request;

class CourseCompleteReport extends Controller
{
    private $registerUserInterface='';
    private $completeInterFace='';

     public function __construct(RegisterUserInterface $registerUserInterface,CourseCompleteInterFace $completeInterFace) {
        $this->middleware(function ($request, $next) {
            \Session::put('top_menu',"course_complete_report");
            \Session::put('sub_menu',"course_complete_report");
            return $next($request);
        });
        $this->registerUserInterface=$registerUserInterface;
        $this->completeInterFace=$completeInterFace;
    }
    public function index()
    {
        $data['divisions']=$this->registerUserInterface->getOnlyDivision();
        $data['designations']=$this->registerUserInterface->getAllDesignation();
        return view("admin.course.course-complete-reports",$data);
    }
    public function view(Request $request)
    {
        return $this->completeInterFace->datatableView($request);
    }
    public function details()
    {
        $id=\request()->input("id");
        $data['single']=$this->registerUserInterface->findById($id);
//         return $data['single'];
        $returnHTML = view('admin.course.user-details')->with($data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
