<?php

namespace App\Repository\Eloquent;

use App\Models\CourseModule;
use App\Models\ModuleProgress;
use Illuminate\Support\Facades\Auth;
use App\Repository\EloquentInterface;
use App\Repository\ModuleProgressInterface;
use App\Repository\CourseModuleRepositoryInterface;

class ModuleProgressRepository implements EloquentInterface,ModuleProgressInterface
{
    private $moduleRepository="";
    public function __construct(CourseModuleRepositoryInterface $moduleRepository) {
        $this->moduleRepository = $moduleRepository;
    }

    public function all(){}

    public function create($data){
        $module=$this->findModule($data->course_module_id);
        if(!$module->is_quiz || isset($data->is_quiz)){
            $moduleProgress=ModuleProgress::where("course_module_id",$data->course_module_id)->where("register_user_id",Auth::id())->first();
            if($moduleProgress)
            {
                $pre_complete_percent=$moduleProgress->complete_percent;
            }
            else{
                $pre_complete_percent=0;
            }
            return ModuleProgress::updateOrCreate(
                ["register_user_id"=>Auth::id(),"course_module_id"=>$data->course_module_id],
                ["register_user_id"=>Auth::id(),"course_module_id"=>$data->course_module_id,"complete_percent"=>$pre_complete_percent>$data->complete_percent?$pre_complete_percent:$data->complete_percent]
            );
        }else{
            return null;
        }

    }

    public function findById($id){
        //return CourseModule::where("id",$id)->firstOrFail();
    }

    public function update($data, $id){}

    public function control($id){}

    public function delete($id){}

    public function findModule($id)
    {
        return $this->moduleRepository->findById($id);
    }
}
