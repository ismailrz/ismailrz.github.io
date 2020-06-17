<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageCategoriesTableSeeder extends Seeder
{
      public function run()
      {
        DB::table('page_categories')->insert([
            [
              'title' => 'Product',
              'status' => '10'
            ],
            [
              'title' => 'Service',
              'status' => '10'
            ],
            [
              'title' => 'Media',
              'status' => '0'
            ],
        ]);
      }    
}
