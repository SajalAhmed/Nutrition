<?php

namespace App\Repository;

interface ModuleSessionInterface
{
    public function getModuleSessionByCourseModule($course_module_id);
    public function deleteWithCourseModuleId($course_module_id);
}
