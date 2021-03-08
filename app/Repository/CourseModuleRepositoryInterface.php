<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface CourseModuleRepositoryInterface
{
    public function getActiveCourseModule();
    public function datatableViewCourseModule();
    public function uploadCourseFile($data,$model=null,$type="zip");
    public function downloadCourseFile(Request $request,$course_module_id,$type="zip");
}
