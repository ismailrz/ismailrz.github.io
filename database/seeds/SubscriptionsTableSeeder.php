<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subscriptions')->insert([
            [
                'subscription_type_user_type_id' => '1',
                'user_id' => '4',
                'total_limit' => '10',
                'remaining_limit' => '10',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(240*3600))) //after 10 days
            ],
            [
                'subscription_type_user_type_id' => '2',
                'user_id' => '4',
                'total_limit' => '10',
                'remaining_limit' => '10',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(240*3600)))
            ],
            [
                'subscription_type_user_type_id' => '3',
                'user_id' => '4',
                'total_limit' => '10',
                'remaining_limit' => '10',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(240*3600)))
            ],
            [
                'subscription_type_user_type_id' => '4',
                'user_id' => '5',
                'total_limit' => '20',
                'remaining_limit' => '20',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(480*3600)))
            ],
            [
                'subscription_type_user_type_id' => '5',
                'user_id' => '5',
                'total_limit' => '20',
                'remaining_limit' => '20',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(480*3600)))
            ],
            [
                'subscription_type_user_type_id' => '6',
                'user_id' => '5',
                'total_limit' => '20',
                'remaining_limit' => '20',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(480*3600)))
            ],
            [
                'subscription_type_user_type_id' => '7',
                'user_id' => '5',
                'total_limit' => '20',
                'remaining_limit' => '20',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(480*3600)))
            ],
            [
                'subscription_type_user_type_id' => '8',
                'user_id' => '5',
                'total_limit' => '20',
                'remaining_limit' => '20',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(480*3600)))
            ],
            [
                'subscription_type_user_type_id' => '9',
                'user_id' => '5',
                'total_limit' => '20',
                'remaining_limit' => '20',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(480*3600)))
            ],
            [
                'subscription_type_user_type_id' => '10',
                'user_id' => '2',
                'total_limit' => '365',
                'remaining_limit' => '365',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(24*365*3600)))
            ],
            [
                'subscription_type_user_type_id' => '11',
                'user_id' => '2',
                'total_limit' => '365',
                'remaining_limit' => '365',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(24*365*3600)))
            ],
            [
                'subscription_type_user_type_id' => '12',
                'user_id' => '2',
                'total_limit' => '365',
                'remaining_limit' => '365',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(24*365*3600)))
            ],
            [
                'subscription_type_user_type_id' => '13',
                'user_id' => '2',
                'total_limit' => '365',
                'remaining_limit' => '365',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(24*365*3600)))
            ],
            [
                'subscription_type_user_type_id' => '14',
                'user_id' => '2',
                'total_limit' => '365',
                'remaining_limit' => '365',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(24*365*3600)))
            ],
            [
                'subscription_type_user_type_id' => '15',
                'user_id' => '2',
                'total_limit' => '365',
                'remaining_limit' => '365',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(24*365*3600)))
            ],
            [
                'subscription_type_user_type_id' => '16',
                'user_id' => '2',
                'total_limit' => '365',
                'remaining_limit' => '365',
                'subscription_starts_at' => date('Y-m-d', time()),
                'subscription_ends_at' => date('Y-m-d', (time()+(24*365*3600)))
            ],
        ]); 
    }
}
