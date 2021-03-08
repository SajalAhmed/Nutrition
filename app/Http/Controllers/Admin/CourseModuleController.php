<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseModuleRequest;
use App\Models\CourseModule;
use App\Repository\CourseRepositoryInterface;
use App\Repository\CourseModuleRepositoryInterface;
use App\Repository\ModuleSessionInterface;

class CourseModuleController extends Controller
{
    private $courseModuleRepository="";
    private $courseRepository="";

    public function __construct(CourseModuleRepositoryInterface $courseModuleRepository,CourseRepositoryInterface $courseRepository) {
        $this->middleware(function ($request, $next) {
            \Session::put('top_menu',"course_module");
            \Session::put('sub_menu',"course_module");
            return $next($request);
        });
        $this->courseModuleRepository = $courseModuleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        checkPermission("course_module",VIEW);
        $data['courses']=$this->courseRepository->getActiveCourse();
        $data['add']=true;
        return view("admin.course_module.index",$data);
    }
    public function add(CourseModuleRequest $request)
    {
        checkPermission("course_module",ADD);
        $this->courseModuleRepository->create($request);
        return response()->json(['success'=>true]);
    }

    public function view()
    {
        return $this->courseModuleRepository->datatableViewCourseModule();
    }
    public function edit()
    {
        checkPermission("course_module",EDIT);
        $course_module_id=\request()->input("course_module_id");
        $data['courses']=$this->courseRepository->getActiveCourse();
        $data['single']=$this->courseModuleRepository->findById($course_module_id);
        // dd($data['single']->toArray());
        $data['edit']=true;
        return view("admin.course_module.index",$data);
    }
    public function update(CourseModuleRequest $request)
    {
        checkPermission("course_module",EDIT);
        $course_module_id=\request()->input("id");
       $course_module= $this->courseModuleRepository->update($request,$course_module_id);
        return response()->json(['success'=>true,"data"=>$course_module]);
    }
    public function control()
    {
        checkPermission("course_module",PUBLISH);
        $course_module_id=\request()->input("course_module_id");
        $this->courseModuleRepository->control($course_module_id);
        return redirect()->route("admin.courseModule");
    }
    public function delete(ModuleSessionInterface $moduleSessionRepository)
    {
        checkPermission("course_module",DELETE);

        $course_module_id=\request()->input("course_module_id");
        $this->courseModuleRepository->findById($course_module_id);
        $moduleSessionRepository->delete($course_module_id);
        $this->courseModuleRepository->delete($course_module_id);
        return redirect()->route("admin.courseModule");
    }
    public function details()
    {
        $id=\request()->input("id");
        $data['single']=$this->courseModuleRepository->findById($id);
        $returnHTML = view('admin.course_module.module-details')->with($data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
