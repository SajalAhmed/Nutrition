<?php

namespace App\Http\Resources;

use id;
use Illuminate\Support\Facades\App;
use App\Http\Resources\EnrolledCourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrolledResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "course"=>new EnrolledCourseResource($this->course),
        ];
    }
}
