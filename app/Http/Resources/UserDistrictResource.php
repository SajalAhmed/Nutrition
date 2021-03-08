<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDistrictResource extends JsonResource
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
                "division"=>new UserDivisionResource($this->division),
            ];
        }else{
            return [
                "id"=>$this->id,
                "name"=>$this->bn_name,
                "division"=>new UserDivisionResource($this->division),
            ];
        }
    }
}
