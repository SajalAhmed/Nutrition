<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $module_count=count($this->courseModules);
        $module_count=$module_count<=2?0:$module_count-2;
        if(file_exists(storage_path()."/app/public/".$this->course_zip_file_name)) {
            $file_size=(File::size(storage_path()."/app/public/".$this->course_zip_file_name) / 1024) / 1024;
             $file_size=sprintf('%.2f', $file_size);
            // $file_size=100;
        }else{
            $file_size=0;
        }
        if (App::isLocale('en')) {
            return [
                "id"=>$this->id,
                "name"=>$this->name_en,
                "picture_url"=>asset("storage/".$this->picture),
                "download_file_url"=>asset("storage/".$this->course_zip_file_name),
                "download_file_size"=>$file_size." MB",
                "module_count"=>$module_count,
            ];
        }else{
            return [
                "id"=>$this->id,
                "name"=>$this->name_bn,
                "picture_url"=>asset("storage/".$this->picture),
                "download_file_url"=>asset("storage/".$this->course_zip_file_name),
                "download_file_size"=>e2b($file_size)." মেগাবাইট",
                "module_count"=>e2b($module_count),
            ];
        }
    }
}
