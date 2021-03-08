<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateDownload extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['register_user_id','course_id'];

}
