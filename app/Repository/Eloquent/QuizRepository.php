<?php

namespace App\Repository\Eloquent;

use App\Components\Certificate;
use App\Models\CertificateDownload;
use App\Models\CourseModule;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;
use App\Repository\EloquentInterface;
use App\Repository\QuizRepositoryInterface;
use App\Repository\CourseModuleRepositoryInterface;
use App\Repository\CourseRepositoryInterface;
use stdClass;

class QuizRepository implements EloquentInterface,QuizRepositoryInterface
{
    private $courseRepository="";
    private $moduleProgress="";
    public function __construct(CourseRepositoryInterface $courseRepository,ModuleProgressRepository $moduleProgress) {
        $this->courseRepository = $courseRepository;
        $this->moduleProgress = $moduleProgress;
    }

    public function all(){}

    public function create($data){
        if($data->percentage>=80){
            $moduleProgress=new stdClass();
            $moduleProgress->register_user_id=Auth::id();
            $moduleProgress->is_quiz=true;
            $moduleProgress->course_module_id=$data->course_module_id;
            $moduleProgress->complete_percent=100;
            $this->moduleProgress->create($moduleProgress);
        }
        $course_module=CourseModule::where("id",$data->course_module_id)->first();
        if($course_module)
        {
            if($course_module->is_quiz)
            {
                $course_id=$course_module->course_id;
                $quizResult=QuizResult::where("course_id",$course_id)->where("register_user_id",Auth::id())->first();
                if($quizResult)
                {
                    $pre_percentage=$quizResult->percentage;
                }else{
                    $pre_percentage=0;
                }
                return QuizResult::updateOrCreate(
                    ['register_user_id'=>Auth::id(),"course_module_id"=>$data->course_module_id],
                    [
                        'register_user_id'=>Auth::id(),
                        "course_module_id"=>$data->course_module_id,
                        "course_id"=>$course_id,
                        "gain_point"=>$data->gain_point,
                        "percentage"=>$pre_percentage>$data->percentage?$pre_percentage:$data->percentage
                    ]
                );
            }
        }
        return null;
    }

    public function findById($id){}

    public function update($data, $id){}

    public function control($id){}

    public function delete($id){}

    public function certificate($data)
    {
        $result=$this->findQuizResult($data['course_id']);
        if($result==null)
        {
            return null;
        }
        if($result->percentage<80)
        {
            return "fail";
        }
        // return $result;
        $result->download=$data['download'];
        if($result->download==true)
        {
            CertificateDownload::updateOrCreate(
                ['register_user_id'=>Auth::id(),"course_id"=>$data['course_id']],
                [
                    'register_user_id'=>Auth::id(),
                    "course_id"=>$data['course_id']
                ]
                );
        }
        $certificate=new Certificate;
        return $certificate->download($result);
    }
    public function certificateCheck($data)
    {
        $result=$this->findQuizResult($data['course_id']);
        if($result==null)
        {
            return null;
        }
        if($result->percentage<80)
        {
            return "fail";
        }
        return $result;
    }
    public function findQuizResult($course_id){
        $result=QuizResult::with("user")->with(['courseModule'=>function($query){
                        $query->with("course");
                    }])->where("course_id",$course_id)
                    ->where("register_user_id",Auth::id())
                    ->firstOrFail();
        return $result;
    }
}
