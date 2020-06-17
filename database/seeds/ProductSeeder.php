<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_type_id' => '1',
                'user_id' => '7',
                'page_id' => '1',
                'title' => 'Prospects 2019',
                'descr' => 'Megazine on our prospects during the year 2019. Download it and know about us to join the caravan',
                'promo_image_id' => '1',
                'price' => '0',
                'quantity' => '',//null
                'discount_parcent' => '0',
                'total_discount' => '0',                
                'average_rating' => '0',
                'total_review' => '0',
                'total_sell_download' => '0',
                'is_free' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_id' => '2',
                'user_id' => '8',
                'page_id' => '2',
                'title' => 'Product Catalog',
                'descr' => 'List of products with price and other details',
                'promo_image_id' => '2',
                'price' => '0',
                'quantity' => '',//null
                'discount_parcent' => '0',
                'total_discount' => '0',                
                'average_rating' => '0',
                'total_review' => '0',
                'total_sell_download' => '0',
                'is_free' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_id' => '2',
                'user_id' => '8',
                'page_id' => '2',
                'title' => 'MensWear',
                'descr' => 'Shirkets, Basic t shirt, hoodies, joggers, bombers, sweatshirts, tanks, shorts and more.',
                'promo_image_id' => '3',
                'price' => '10',
                'quantity' => '10000',
                'discount_parcent' => '0',
                'total_discount' => '0',                
                'average_rating' => '0',
                'total_review' => '0',
                'total_sell_download' => '0',
                'is_free' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_id' => '1',
                'user_id' => '1',
                'page_id' => '',//null
                'title' => 'Megazine: Textile Today April 2020',
                'descr' => 'It’s a comprehensive magazine for textile, apparel & fashion industry.',
                'promo_image_id' => '4',
                'price' => '0',
                'quantity' => '',//null
                'discount_parcent' => '0',
                'total_discount' => '0',                
                'average_rating' => '0',
                'total_review' => '0',
                'total_sell_download' => '0',
                'is_free' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_id' => '1',
                'user_id' => '1',
                'page_id' => '',//null
                'title' => 'Megazine: Textile Today March 2020',
                'descr' => 'It’s a comprehensive magazine for textile, apparel & fashion industry.',
                'promo_image_id' => '5',
                'price' => '0',
                'quantity' => '',//null
                'discount_parcent' => '0',
                'total_discount' => '0',                
                'average_rating' => '0',
                'total_review' => '0',
                'total_sell_download' => '0',
                'is_free' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
        ]);
    }
}
