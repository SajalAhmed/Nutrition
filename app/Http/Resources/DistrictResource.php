<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use App\Http\Resources\UpzillaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
                "name"=>$this->name,
                "upazillas"=>UpzillaResource::collection($this->upazillas),
            ];
        }else{
            return [
                "id"=>$this->id,
                "name"=>$this->bn_name,
                "upazillas"=>UpzillaResource::collection($this->upazillas),
            ];
        }
    }
}
