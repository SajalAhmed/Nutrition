<?php

namespace App\Repository;

interface CourseRepositoryInterface
{
    public function getActiveCourse();

    public function getCourseDetailsWithModule($course_id);
    public function getMyCourseDetailsWithModule();
    public function enrolledCourse($course_id);
    public function uploadImage($data,$model=null);
    public function get_course_file($course_id);
}
