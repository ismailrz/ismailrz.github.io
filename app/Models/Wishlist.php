<?php

namespace App\Models\Wishlist;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model {
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
