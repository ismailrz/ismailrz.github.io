<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
   protected $fillable = ['title', 'descr', 'status'];
   
   public function posts(){
        return $this->hasMany(App\Models\Post::class);
    }
}
