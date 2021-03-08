<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class UserUpazillaResource extends JsonResource
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
                "district"=>new UserDistrictResource($this->district),
            ];
        }else{
            return [
                "id"=>$this->id,
                "name"=>$this->bn_name,
                "district"=>new UserDistrictResource($this->district),
            ];
        }
    }
}
