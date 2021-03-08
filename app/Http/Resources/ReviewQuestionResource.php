<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewQuestionResource extends JsonResource
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
                "answers"=>ReviewQuestionAnswerResource::collection($this->answers)
            ];
        }else{
            return [
                "id"=>$this->id,
                "title"=>$this->title_bn,
                "answers"=>ReviewQuestionAnswerResource::collection($this->answers)
            ];
        }
    }
}
