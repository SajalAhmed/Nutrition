<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use App\Http\Resources\DistrictResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
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
                "districts"=>DistrictResource::collection($this->districts),
            ];
        }else{
            return [
                "id"=>$this->id,
                "name"=>$this->bn_name,
                "districts"=>DistrictResource::collection($this->districts),
            ];
        }
    }
}
