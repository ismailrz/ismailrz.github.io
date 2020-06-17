<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function users(){
        return $this->belongsToMany(User::class);
    }
    
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
    
    public function interestGroups(){
        return $this->belongsToMany(App\Models\Admin\InterestGroup::class);
    }

    public function jobType(){
        return $this->belongsTo(App\Models\Admin\JobType::class);
    }

    public function organization(){
        return $this->belongsTo('App\Models\Admin\Organization');
    }
    
    public function likes(){
        return $this->morphMany('App\Models\Like','likeable');
    }
    
    public function flags(){
        return $this->morphMany('App\Models\Flag', 'flaggable');
    }    

    public static function get_jobs($userId, $limit, $page){
        $jobs = Job::with('organization')
            ->with(['users' => function ($query){
                $query->select('users.id','name','profile_picture')
                    ->where('is_creator','=',1);
            }])
            ->paginate($limit);

        foreach($jobs as $k => $q) {
            $jobs[$k]->responsibilities = substr($jobs[$k]->responsibilities, 0, 150);
            if(count($jobs[$k]['likes']) > 0){
                $jobs[$k]['like_user_id'] = 1;
                unset($jobs[$k]['likes']);
            }
        }    
        return response()->json(['jobs' =>$jobs ]);
    }
}
