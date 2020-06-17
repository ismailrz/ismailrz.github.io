<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('organization_user')->insert([
            [
                'organization_id' => '1',
                'user_id' => '7',
                'is_creator' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organization_id' => '3',
                'user_id' => '8',
                'is_creator' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
