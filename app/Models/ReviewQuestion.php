<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewQuestionAnswer;

class ReviewQuestion extends Model
{
  public function answers()
  {
      return $this->hasMany(\App\Models\ReviewQuestionAnswer::class);
  }
}
