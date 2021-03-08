<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use App\Http\Resources\ModuleProgressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrolledCourseModuleResource extends JsonResource
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
                "title"=>$this->title_en,
                "minute"=>$this->minute_en,
                "module_progress"=>new ModuleProgressResource($this->moduleProgress)
            ];
        }else{
            return [
                "id"=>$this->id,
                "title"=>$this->title_bn,
                "minute"=>$this->minute_bn,
                "module_progress"=>new ModuleProgressResource($this->moduleProgress)
            ];
        }
    }
}
