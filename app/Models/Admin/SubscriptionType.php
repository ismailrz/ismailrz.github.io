<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model {
    
    public function userTypes(){
        return $this->belongsToMany('App\Models\Admin\SubscriptionType');
    }
}
