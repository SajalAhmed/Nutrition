<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upazilla extends Model
{
    public function district()
    {
        return $this->belongsTo(\App\Models\District::class);
    }
}
