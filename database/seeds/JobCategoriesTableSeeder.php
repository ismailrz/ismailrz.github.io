<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategoriesTableSeeder extends Seeder
{
   /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run()
      {

          DB::table('job_categories')->insert([

              [
                'title' => 'IT',
                'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                'status' => '10'
              ],


              [
                'title' => 'Garments',
                'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
                'status' => '0'
              ],

              [
                'title' => 'Admistration',
                'descr' => 'At vero eos et accusamus et iusto odio dignissimos  asdf ducimus qui blanditiis',
                'status' => '10'
              ],

              

          ]);

      }
}
