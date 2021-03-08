<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseModule extends Model
{
    use SoftDeletes;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id','title_bn','title_en','minute_en','minute_bn','zip_file_name','status','position','is_quiz'];

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class);
    }
    public function sessions()
    {
        return $this->hasMany(\App\Models\ModuleSession::class);
    }
    public function moduleProgress()
    {
        return $this->hasOne(\App\Models\ModuleProgress::class)->where("register_user_id",Auth::id());
    }
}
