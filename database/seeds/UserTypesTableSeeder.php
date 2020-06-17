<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_types')->insert([
           [
             'title' => 'Free Member',
		         'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis'
           ],
           [
             'title' => 'Trial Member',
		         'descr' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis'
           ],
           [
             'title' => 'Associate Member',
		         'descr' => 'Associate members scopes should be mentioned here.',
           ],
           [
             'title' => 'Member',
             'descr' => 'Members scopes should be mentioned here.'
           ]
       ]);
    }
}
