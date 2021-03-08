<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RegisterUser extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function upazilla()
    {
        return $this->belongsTo(\App\Models\Upazilla::class)->with(["district"=>function($query){
            $query->with("division");
        }]);
    }
    public function designation()
    {
        return $this->belongsTo(\App\Models\Designation::class);
    }
    public function affiliated()
    {
        return $this->belongsTo(\App\Models\Affiliated::class);
    }

    public function quiz()
    {
        return $this->hasOne(\App\Models\QuizResult::class,'register_user_id','id');
    }
}
