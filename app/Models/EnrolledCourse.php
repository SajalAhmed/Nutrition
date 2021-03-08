<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrolledCourse extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['register_user_id','course_id'];

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class)->with(["courseModules"=>function($query){
            $query->with("moduleProgress");
            $query->where("status",1);
            $query->orderBY("position","ASC");
        }]);
    }
}
