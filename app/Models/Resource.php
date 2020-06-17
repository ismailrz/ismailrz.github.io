<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{    
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function page(){
        return $this->belongsTo(App\Models\Page::class);
    }
    
    public function images(){
        return $this->morphMany('App\Models\Image','imagable');
    }  
}
