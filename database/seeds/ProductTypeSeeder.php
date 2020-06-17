<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_types')->insert([
            [
              'title' => 'Book/Megazine',
              'icon' => 'https://via.placeholder.com/150',
              'descr' => 'Soft copy of book, megazine, tabloyed etc should goes in this category',
              'status' => '1'
            ],
            [
              'title' => 'Apparel accessories',
              'icon' => 'https://via.placeholder.com/150',
              'descr' => 'Product of apparel accessories',
              'status' => '1'
            ],
            [
              'title' => 'Fiber & Yarn',
              'icon' => 'https://via.placeholder.com/150',
              'descr' => 'All types of fiber and yarn',
              'status' => '1'
            ],
        ]);
    }
}
