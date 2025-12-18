<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Guard;

class Profile extends Model
{
    protected $fillable= ["user_id","Imgae","Nick_name","Occupation","Salary"];
    protected $table="profiles";
    
     public function user() {
        return $this->belongsTo(User::class);
    }

}
