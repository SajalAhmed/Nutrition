<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRegisterResource extends JsonResource
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
            "name"=>$this->name,
            "email"=>$this->email,
            "phone_number"=>$this->phone_number,
            "affiliated"=>new AffiliatedResource($this->affiliated),
            "gender"=>App::isLocale('en')?genderDAE($this->gender):genderDAB($this->gender),
            "organization"=>$this->organization,
            "designation_other"=>$this->designation_other,
            "designation"=>new DesignationResource($this->designation),
            "age"=>$this->age,
            "upazila"=>new UserUpazillaResource($this->upazilla)
        ];
    }
}
