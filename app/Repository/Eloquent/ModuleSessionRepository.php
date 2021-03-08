<?php

namespace App\Repository\Eloquent;

use App\Models\ModuleSession;
use App\Repository\EloquentInterface;
use App\Repository\ModuleSessionInterface;

class ModuleSessionRepository implements EloquentInterface,ModuleSessionInterface
{
    public function all(){
        return ModuleSession::orderBy("id","DESC")->get();
    }

    public function create($data){

    }

    public function findById($id){
        return ModuleSession::findOrFail($id);
    }

    public function update($data, $id){
    }

    public function control($id){
    }

    public function delete($id){
    }
    public function getModuleSessionByCourseModule($course_module_id){
        return ModuleSession::where("course_module_id",$course_module_id)->orderBy("id","DESC")->get();
    }
    public function deleteWithCourseModuleId($course_module_id){
        return ModuleSession::where("course_module_id",$course_module_id)->delete();
    }

}
