<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('post_categories')->insert([
            [
                'title' => 'Analysis',
                'descr' => 'Analysis on specific topic shared by admin',
                'status' => '10'
            ],
            [
                'title' => 'Case Study',
                'descr' => 'Case study shared by editorial body or admin.',
                'status' => '10'
            ],
            [
                'title' => 'Interview',
                'descr' => 'Interview shared by editorial body or admin.',
                'status' => '10'
            ],
            [
                'title' => 'News',
                'descr' => 'Important news shared by admin or users',
                'status' => '10'
            ],
            [
                'title' => 'Regular Status',
                'descr' => 'Regular Status/Post by most of the common users.',
                'status' => '10'
            ],
            [
                'title' => 'Review',
                'descr' => 'Technical review or product review from admin section.',
                'status' => '10'
            ],
        ]);
    }
}
