<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Boolean;

class AppVersionResource extends JsonResource
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
            "version_code"=>(int)$this->version_code,
            "version_name"=>$this->version_name,
            "force_update"=>(Boolean)$this->force_update,
        ];
    }
}
