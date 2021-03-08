<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrolledCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (App::isLocale('en')) {
            return [
                "id"=>$this->id,
                "name"=>$this->name_en,
                "course_modules"=>EnrolledCourseModuleResource::collection($this->courseModules),
            ];
        }else{
            return [
                "id"=>$this->id,
                "name"=>$this->name_bn,
                "course_modules"=>EnrolledCourseModuleResource::collection($this->courseModules),
            ];
        }
    }
}
