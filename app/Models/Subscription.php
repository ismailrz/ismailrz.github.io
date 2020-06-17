<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {   
    
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function subscription_type_user_type(){
        return $this->belongsTo(App\Models\SubscriptionTypeUserType::class);
    }

    public function initialize_subscriptions($userTypeId, $userId){
        $subscriptionTypesByUserType = $this->SubscriptionTypeUserType->get_subscription_types_by_user_type($userTypeId);

    }
}
