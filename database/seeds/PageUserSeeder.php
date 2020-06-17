<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PageUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('page_user')->insert([
            [
                'page_id' => '1',
                'user_id' => '7',
                'is_creator' => '1',
                'is_liked' => '0',
                'is_following' => '0'
            ],
            [
                'page_id' => '2',
                'user_id' => '8',
                'is_creator' => '1',
                'is_liked' => '0',
                'is_following' => '0'
            ],
        ]);
    }
}
