<?php

namespace App\Repository\Eloquent;

use Exception;
use App\Models\CourseModule;
use App\Traits\ActionColumn;
use Illuminate\Http\Request;
use App\Models\ModuleSession;
use App\Components\ZipFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Repository\EloquentInterface;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\ModuleSessionInterface;
use App\Repository\CourseModuleRepositoryInterface;

class CourseModuleRepository implements EloquentInterface,CourseModuleRepositoryInterface
{
    use ActionColumn;
    public function all(){
        return CourseModule::with("course")->orderBy("position","ASC")->get();
    }

    public function create($data){
        $zip_file_name=$this->uploadCourseFile($data);
        $courseModule=null;

        DB::beginTransaction();
        try{
            $courseModule=CourseModule::create([
                'course_id' => $data->course_id,
                'title_en' => $data->title_bn,
                'title_bn' => $data->title_bn,
                'position' => $data->position,
                'is_quiz' => $data->is_quiz,
                'minute_en' => $data->minute_en,
                'minute_bn' => e2b($data->minute_en),
                'zip_file_name' => $zip_file_name
            ]);
            if($data->session_title_bn[0]!=null)
            {
                $session_data=array();
                foreach($data->session_title_bn as $key=>$value)
                {
                    $session_data[$key]['course_module_id']=$courseModule->id;
                    $session_data[$key]['title_en']=$value;
                    $session_data[$key]['title_bn']=$value;
                }
                ModuleSession::insert($session_data);
            }
            setMessage("message",'success',"Course Module Create Successfully");
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
            setMessage("message",'danger',"Something went wrong");
        }
        return $courseModule;
    }

    public function findById($id){
        return CourseModule::with("sessions")->with("course")->findOrFail($id);
    }

    public function update($data, $id){
        $courseModule = $this->findById($id);
        $zip_file_name=$this->uploadCourseFile($data,$courseModule);

        DB::beginTransaction();
        try{
            $courseModule->course_id=$data->course_id;
            $courseModule->title_en=$data->title_bn;
            $courseModule->title_bn=$data->title_bn;
            $courseModule->minute_en=$data->minute_en;
            $courseModule->is_quiz=$data->is_quiz;
            $courseModule->minute_bn=e2b($data->minute_en);
            $courseModule->position=$data->position;
            if($zip_file_name!='')
            $courseModule->zip_file_name=$zip_file_name;

            $courseModule->save();

            @ModuleSession::where("course_module_id",$courseModule->id)->delete();
            if($data->session_title_bn[0]!=null)
            {
                $session_data=array();
                foreach($data->session_title_bn as $key=>$value)
                {
                    $session_data[$key]['course_module_id']=$courseModule->id;
                    $session_data[$key]['title_en']=$value;
                    $session_data[$key]['title_bn']=$value;
                }
                ModuleSession::insert($session_data);
            }
            setMessage("message",'success',"Course Module Update Successfully");
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
            setMessage("message",'danger',"Something went wrong");
        }
        return $courseModule;
    }

    public function control($id){
        $courseModule = $this->findById($id);
        $courseModule->status=!$courseModule->status;
        setMessage("message",'success',"Status Changed Successfully");
        return $courseModule->save();
    }

    public function delete($id){
        $courseModule = $this->findById($id);
        setMessage("message",'success',"Course Module Delete Successfully");
        if(file_exists("storage/".$courseModule->zip_file_name.'.zip')) {
            File::delete("storage/".$courseModule->zip_file_name.'.zip');
        }
        Storage::deleteDirectory("public/".$courseModule->zip_file_name);
        return $courseModule->delete();
    }

    public function getActiveCourseModule(){
        return CourseModule::where("status",1)->orderBy("position","ASC")->get();
    }
    public function datatableViewCourseModule()
    {
        $course_modules=$this->all();
        return DataTables::of($course_modules)
            ->editColumn('course_id', function ($course_modules) {
                return $course_modules->course ? $course_modules->course->name_bn : 'N/A';
            })
            ->addColumn('details', function ($course_modules) {
                return '<button class="btn btn-primary waves-effect waves-light details" data-toggle="modal" data-id="'.$course_modules->id.'" data-target="#con-close-modal"><i class="mdi mdi-format-list-bulleted-triangle"></i></button>';
            })
            ->addColumn('action', function ($course_modules) {
                return $this->courseModuleAction($course_modules);
            })
            ->rawColumns(['details','action'])
            ->make(true);
    }
    public function uploadCourseFile($data,$courseModule=null,$type="zip"){
        $file_url='';
        if ($data->hasFile('zip_file_name')) {
            if($type=="zip")
            {
                $zip=new ZipFile($data);
                $file_url="module/".$zip->upload();
            }
            if($data->id!="")
            {
                if(file_exists("storage/".$courseModule->zip_file_name.'.zip')) {
                    File::delete("storage/".$courseModule->zip_file_name.'.zip');
                }
                Storage::deleteDirectory("public/".$courseModule->zip_file_name);
            }
        }
        return $file_url;
    }
    public function downloadCourseFile(Request $request,$course_module_id,$type="zip")
    {
        $module=$this->findById($course_module_id);
        if($type=="zip")
        {
            $zip=new ZipFile($request);
            return $zip->download($module->zip_file_name);
        }
    }
}
