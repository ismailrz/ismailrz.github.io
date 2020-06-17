<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('subscription_types')->insert([
        [
          'title' => 'Premium Article Access',
          'subscription_type_code' => 'premium_article_access',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10'
        ],
        [
          'title' => 'Page Creation',
          'subscription_type_code' => 'page_creation',
          'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
          'status' => '10'
        ],

                   [
                     'title' => 'Job Post Creation',
                     'subscription_type_code' => 'job_post_creation',
                     'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                     'status' => '10'
                   ],
                   [
                     'title' => 'Classified Post Creation',
                     'subscription_type_code' => 'classified_post_creation',
                     'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                     'status' => '10'
                   ],
                   [
                     'title' => 'Event Creation',
                     'subscription_type_code' => 'event_creation',
                     'descr' => 'At vero eos et accusamus et iusto odio dignissimos  asdf ducimus qui blanditiis',
                     'status' => '0'
                   ],
                   [
                    'title' => 'Event Invitation',
                    'subscription_type_code' => 'event_invitation',
                    'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                    'status' => '10'
                  ],
                  [
                    'title' => 'Job Application',
                    'subscription_type_code' => 'job_application',
                    'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                    'status' => '10'
                  ],
               ]);
    }
}
