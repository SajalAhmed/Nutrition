<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleSession extends Model
{
    use SoftDeletes;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title_bn','title_en','course_module_id ','status'];

    public function courseModule()
    {
        return $this->belongsTo(\App\Models\CourseModule::class);
    }
}
