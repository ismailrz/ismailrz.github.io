<?php

use Illuminate\Database\Seeder;

class OrganizationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization_types')->insert([
            [
              'title' => 'Educational Institute',
              'descr' => 'College, Institute or Universities will be in this category',
              'status' => '10'
            ],
            [
              'title' => 'Textile Mill',
              'descr' => 'Raw material product processing industries will be in this category',
              'status' => '10'
            ],
            [
              'title' => 'Apparel Manufacturing',
              'descr' => 'Transfor fabric into clothes',
              'status' => '10'
            ],
        ]);
    }
}