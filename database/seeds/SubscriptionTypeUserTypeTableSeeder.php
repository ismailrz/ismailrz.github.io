<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubscriptionTypeUserTypeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subscription_type_user_type')->insert([
            [
                'subscription_type_id' => '3', 
                'user_type_id' => '1', 
                'total_limit' => '10',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '4', 
                'user_type_id' => '1', 
                'total_limit' => '10',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '5', 
                'user_type_id' => '1', 
                'total_limit' => '10',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '2', 
                'user_type_id' => '3', 
                'total_limit' => '20',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '3', 
                'user_type_id' => '3', 
                'total_limit' => '20',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '4', 
                'user_type_id' => '3', 
                'total_limit' => '20',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '5', 
                'user_type_id' => '3', 
                'total_limit' => '20',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '6', 
                'user_type_id' => '3', 
                'total_limit' => '20',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '7', 
                'user_type_id' => '3', 
                'total_limit' => '20',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '1', 
                'user_type_id' => '4', 
                'total_limit' => '365', 
                'is_limit_in_days' => true
            ],
            [
                'subscription_type_id' => '2', 
                'user_type_id' => '4', 
                'total_limit' => '100',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '3', 
                'user_type_id' => '4', 
                'total_limit' => '100',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '4', 
                'user_type_id' => '4', 
                'total_limit' => '100',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '5', 
                'user_type_id' => '4', 
                'total_limit' => '100',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '6', 
                'user_type_id' => '4', 
                'total_limit' => '100',
                'is_limit_in_days' => false
            ],
            [
                'subscription_type_id' => '7', 
                'user_type_id' => '4', 
                'total_limit' => '100',
                'is_limit_in_days' => false
            ],
        ]);            
    }
}
