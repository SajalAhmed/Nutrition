<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public function districts()
    {
        return $this->hasMany(\App\Models\District::class)->with("upazillas");
    }
}
