<?php

namespace App\Repository\Eloquent;

use Exception;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\EnrolledCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Repository\EloquentInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Repository\CourseRepositoryInterface;

class CourseRepository implements EloquentInterface,CourseRepositoryInterface
{
    public function all(){
        return Course::orderBy("id","DESC")->get();
    }

    public function create($data){
        $picture_url=$this->uploadImage($data);
        $course_zip_file_name=$this->uploadCourseFile($data,null);
        if($course_zip_file_name!='')
        {
            $data->course_zip_file_name = $course_zip_file_name;
        }
        $course=Course::create([
            'name_en' => $data->name_en,
            'name_bn' => $data->name_bn,
            'picture' => $picture_url,
            'course_zip_file_name' => $data->course_zip_file_name,
            'purpose_en' => $data->purpose_en,
            'purpose_bn' => $data->purpose_bn,
            'method_en' => $data->method_en,
            'method_bn' => $data->method_bn,
        ]);
        setMessage("message",'success',"Course Create Successfully");
        return $course;
    }

    public function findById($id){
        return Course::findOrFail($id);
    }

    public function update($data, $id){
        $course = $this->findById($id);
        $picture_url=$this->uploadImage($data,$course);
        $course_zip_file_name=$this->uploadCourseFile($data,$course);
        if($picture_url!='')
        {
            $course->picture = $picture_url;
        }
        if($course_zip_file_name!='')
        {
            $course->course_zip_file_name = $course_zip_file_name;
        }
        $course->name_en = $data->name_en;
        $course->name_bn = $data->name_bn;
        $course->purpose_en = $data->purpose_en;
        $course->purpose_bn = $data->purpose_bn;
        $course->method_en = $data->method_en;
        $course->method_bn = $data->method_bn;
        $course->save();
        setMessage("message",'success',"Course Update Successfully");
        return $course;
    }

    public function control($id){
        $course = $this->findById($id);
        $course->status=!$course->status;
        setMessage("message",'success',"Status Changed Successfully");
        return $course->save();
    }

    public function delete($id){
        $course = $this->findById($id);
        setMessage("message",'success',"Course Delete Successfully");
        if(file_exists("storage/".$course->picture)) {
            File::delete("storage/".$course->picture);
        }
        return $course->delete();
    }

    public function getActiveCourse(){
        return Cache::rememberForever('getActiveCourse', function () {
            return Course::where("status",1)->with('courseModules')->orderBy("id","DESC")->get();
        });
    }
    public function getCourseDetailsWithModule($course_id){
        return Cache::rememberForever('courseModuleWithDetails'.$course_id, function () use ($course_id) {
            $course=Course::where("status",1)->with(['courseModules'=>function($query){
                $query->where("status",1);
                $query->orderBY("position","ASC");
            }])->with("enrolled")
            ->orderBy("id","DESC")
            ->findOrFail($course_id);
            $course->total_time=CourseModule::where("course_id",$course_id)->where("status",1)->sum("minute_en");
            return $course;
        });
    }
    public function getMyCourseDetailsWithModule(){
        $course=EnrolledCourse::with('course')
        ->orderBy("id","DESC")
        ->where("register_user_id",Auth::id())
        ->get();
        return $course;
    }

    public function enrolledCourse($course_id)
    {
        $course=$this->findById($course_id);
        return EnrolledCourse::updateOrCreate(
            ['register_user_id'=>Auth::id(),"course_id"=>$course->id],
            ['register_user_id'=>Auth::id(),"course_id"=>$course->id]
        );
    }
    public function searchCourse($search_key)
    {
        return Course::where('name_en', 'LIKE', "%{$search_key}%")->orWhere('name_bn', 'LIKE', "%{$search_key}%")->where("status",1)->get();
    }
    public function uploadImage($data,$course=null){
        if ($data->hasFile('picture')) {
            $pictureinfo = $data->file("picture");
            $picture_name = time() . "C." . $pictureinfo->getClientOriginalExtension();
            $data->file("picture")->storeAs("public/course",$picture_name);
            if($data->id!="")
            {
                if(file_exists("storage/".$course->picture)) {
                    File::delete("storage/".$course->picture);
                }
            }
            return "course/".$picture_name;
        }
        return "";
    }
    public function get_course_file($course_id)
    {
        // $course=$this->findById($course_id);
        $course=Course::with(["courseModules"=>function($query){
                        $query->orderBy("position","asc");
                        $query->where("status",1);
                    }])->where("id",$course_id)->firstOrFail();
        // return $course->courseModules;
        $data=[];
        // $directories = Storage::disk('local')->allFiles('public/module/1595741569C_1');
        // return $course->courseModules;
        if($course->courseModules){
            foreach($course->courseModules as $key=>$value){
                if($key==0){
                    // if(is_dir(asset("storage/module/1597814723C_1/data/")))
                    // $data[]=$value->zip_file_name;
                    $directories=Storage::disk('local')->allFiles('public/'.$value->zip_file_name);
                    // unset($directories[0], $directories[1]);

                    if(!empty($directories))
                    {
                        foreach($directories as &$sValue)
                        {
                            $temp_url=substr($sValue,6);
                            $temp_value=explode("/",$sValue)[0];
                            // if ($sValue=='public'){

                            // }
                            $sValue=url("")."/public/storage".$temp_url;
                        }
                      //  $directories[count($directories)]=asset("storage/".$value->zip_file_name."/index.html");
                        $data[]=$directories;
                    }
                }

            }
        }
        if(!empty($data)){
            return call_user_func_array("array_merge", $data);
        }
        return $data;
    }
    public function uploadCourseFile($data,$course=null){
        if ($data->hasFile('course_zip_file_name')) {
            $zip_file_info = $data->file("course_zip_file_name");
            $zip_file_name = time() . "C." . $zip_file_info->getClientOriginalExtension();
            $data->file("course_zip_file_name")->storeAs("public/course",$zip_file_name);
            if($data->id!="")
            {
                if(file_exists("storage/".$course->course_zip_file_name)) {
                    File::delete("storage/".$course->course_zip_file_name);
                }
            }
            return "course/".$zip_file_name;
        }
        return "";
    }
    public function file_size($file_path)
    {
        return round((File::size($file_path) / 1024) / 1024, 2, PHP_ROUND_HALF_UP);
    }
}
