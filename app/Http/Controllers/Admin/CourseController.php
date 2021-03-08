<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseFromRequest;
use App\Repository\CourseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    private $courseRepository="";

    public function __construct(CourseRepositoryInterface $courseRepository) {
        $this->middleware(function ($request, $next) {
            \Session::put('top_menu',"course");
            \Session::put('sub_menu',"course");
            return $next($request);
        });
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        checkPermission("course",VIEW);
        $data['courses']=$this->courseRepository->all();
        $data['add']=true;
        return view("admin.course.index",$data);
    }
    public function add(CourseFromRequest $request)
    {
        checkPermission("course",ADD);
        $this->courseRepository->create($request);
        return redirect()->route("admin.course");
    }
    public function edit()
    {
        checkPermission("course",EDIT);
        $course_id=\request()->input("course_id");
        $data['courses']=$this->courseRepository->all();
        $data['single']=$this->courseRepository->findById($course_id);
        $data['edit']=true;
        return view("admin.course.index",$data);
    }
    public function update(CourseFromRequest $request)
    {
        checkPermission("course",EDIT);
        $course_id=\request()->input("course_id");
        $this->courseRepository->update($request,$course_id);
        return redirect()->route("admin.course");
    }
    public function control()
    {
        checkPermission("course",PUBLISH);
        $course_id=\request()->input("course_id");
        $this->courseRepository->control($course_id);
        return redirect()->route("admin.course");
    }
    public function delete()
    {
        checkPermission("course",DELETE);
        $course_id=\request()->input("course_id");
        $this->courseRepository->delete($course_id);
        return redirect()->route("admin.course");
    }
    public function details()
    {
        $course_id=\request()->input("id");
        $course=$this->courseRepository->findById($course_id);
        $course->picture=asset("storage/".$course->picture);
        return response()->json(['course'=>$course]);
    }

}
