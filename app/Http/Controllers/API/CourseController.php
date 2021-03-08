<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseDetailWithModuleResources;
use App\Http\Resources\CourseResource;
use App\Http\Resources\EnrolledResource;
use App\Repository\CourseModuleRepositoryInterface;
use App\Repository\CourseRepositoryInterface;

class CourseController extends Controller
{
    private $courseRepository="";

    public function __construct(CourseRepositoryInterface $courseRepository,CourseModuleRepositoryInterface $courseModuleRepository) {
        $this->courseRepository = $courseRepository;
        $this->courseModuleRepository = $courseModuleRepository;
    }

    public function getCourse()
    {
        $courses=$this->courseRepository->getActiveCourse();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Ongoing Courses'],
            'data'=>CourseResource::collection($courses)
        ],200);
    }
    public function getCourseDetailsWithModule()
    {
        $course_id=\request()->input("course_id");
        $courses=$this->courseRepository->getCourseDetailsWithModule($course_id);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Course Details'],
            'data'=>new CourseDetailWithModuleResources($courses)
        ],200);
    }

    public function getMyCourseDetailsWithModule()
    {
        $courses=$this->courseRepository->getMyCourseDetailsWithModule();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['My Course Details'],
            'data'=>EnrolledResource::collection($courses)
        ],200);
    }

    public function enrolledCourse()
    {
        $course_id=\request()->input("course_id");
        $enrolled_course=$this->courseRepository->enrolledCourse($course_id);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Course Enrolled Successfuly'],
            'data'=>$enrolled_course
        ],200);
    }
    public function searchCourse()
    {
        $search_key=request()->input("search_key");
        $courses=$this->courseRepository->searchCourse($search_key);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Your Search Course'],
            'data'=>CourseResource::collection($courses)
        ],200);
    }

    public function get_course_file()
    {
        $course_id=\request()->input("course_id");
        $course_file=$this->courseRepository->get_course_file($course_id);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>['Course File'],
            'data'=>$course_file
        ],200);
    }
}
