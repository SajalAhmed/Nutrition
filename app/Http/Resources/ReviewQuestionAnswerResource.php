<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewQuestionAnswerResource extends JsonResource
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
                "review_question_id"=>$this->review_question_id,
                "name"=>$this->name_en
            ];
        }else{
            return [
                "id"=>$this->id,
                "review_question_id"=>$this->review_question_id,
                "name"=>$this->name_bn
            ];
        }
    }
}
