<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    public function run()
    {
        DB::table('pages')->insert([
            [
                'page_category_id' => '2',
                'title' => 'Ahsanullah University',
                'about' => 'Ahsanullah University of Science and Technology or commonly known as AUST first non-government engineering university to be established in Bangladesh',
                'phone' => '02-8870422',
                'email' => 'info@aust.edu',
                'website' => 'http://www.aust.edu/',
                'logo' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/12/AUST-96x96.png',
                'banner' => 'https://jobs.textiletoday.com.bd/wp-content/uploads/2019/12/AUST-96x96.png',
                'total_like' => '0',
                'total_follow' => '0',
                'status' => '10',
                'starts_at' => now(),
                'created_at' => now(),
                'updated_at' => now()->addMonth(),
            ],
            [
                'page_category_id' => '1',
                'title' => 'Robintex Group',
                'about' => 'Robintex-Group has been operating in the export oriented composite knit garment industry of Bangladesh since 1996',
                'phone' => '880-2-48811428 ',
                'email' => 'mail@robintexbd.com',
                'website' => 'www.robintexbd.com',
                'logo' => 'http://www.robintexbd.com/images/robin.png',
                'banner' => 'http://www.robintexbd.com/images/robin.png',
                'total_like' => '0',
                'total_follow' => '0',
                'status' => '10',
                'starts_at' => now(),
                'created_at' => now(),
                'updated_at' => now()->addMonth(),
            ]
        ]);
    }
}
