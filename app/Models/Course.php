<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en','name_bn','picture','purpose_en','purpose_bn','method_en','method_bn','status'];

    public function courseModules()
    {
        return $this->hasMany(\App\Models\CourseModule::class)->with("sessions");
    }
    public function enrolled()
    {
        return $this->hasOne(\App\Models\EnrolledCourse::class)->where("register_user_id",Auth::id());
    }
}
