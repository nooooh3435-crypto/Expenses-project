<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable=["user_id","amount","date","description"];
    protected $table= "expenses";

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
