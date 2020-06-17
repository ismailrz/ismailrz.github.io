<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public function subscription_types(){
        return $this->belongsToMany('App\Models\Admin\UserType');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
