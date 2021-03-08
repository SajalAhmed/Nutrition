<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleProgressResource extends JsonResource
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
                "percent_int"=>$this->complete_percent,
                "last_date"=>date("d F Y",strtotime($this->updated_at)),
                "complete_percent"=>$this->complete_percent,
            ];
        }else{
            return [
                "id"=>$this->id,
                "percent_int"=>$this->complete_percent,
                "last_date"=>e2b(date("d F Y",strtotime($this->updated_at))),
                "complete_percent"=>e2b($this->complete_percent),
            ];
        }
    }
}
