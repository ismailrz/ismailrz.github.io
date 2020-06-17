<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }
    
    public function flaggable(){
        return $this->morphTo();
    }
}
