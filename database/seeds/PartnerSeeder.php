<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        DB::table('partners')->insert([
            [
                'partnerable_type' => 'App\Models\Organization',
                'partnerable_id' => '1',
                'status' => '10',
                'sort_order' => '100',
                'partnership_started_at' => now(),
                'partnership_ended_at' => now()->addMonth(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'partnerable_type' => 'App\Models\Organization',
                'partnerable_id' => '3',
                'status' => '10',
                'sort_order' => '200',
                'partnership_started_at' => now(),
                'partnership_ended_at' => now()->addMonth(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'partnerable_type' => 'App\Models\User',
                'partnerable_id' => '6',
                'status' => '10',
                'sort_order' => '300',
                'partnership_started_at' => now(),
                'partnership_ended_at' => now()->addMonth(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        
    }
}
