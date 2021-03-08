<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function upazillas()
    {
        return $this->hasMany(\App\Models\Upazilla::class);
    }
    public function division()
    {
        return $this->belongsTo(\App\Models\Division::class);
    }
}
