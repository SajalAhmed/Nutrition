<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['register_user_id','course_id','course_module_id','gain_point','percentage'];

    public function user()
    {
        return $this->hasOne(\App\Models\RegisterUser::class,'id','register_user_id')->with("upazilla",'designation','affiliated');
    }
    public function courseModule()
    {
        return $this->belongsTo(\App\Models\CourseModule::class);
    }
}
