<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewQuestionAnswer extends Model
{
    public function question()
    {
        return $this->belongsTo(\App\Models\ReviewQuestion::class);
    }
}
