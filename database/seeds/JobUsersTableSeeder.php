<?php

use Illuminate\Database\Seeder;

class JobUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_user')->insert([
            [
                'job_id' => '2',
                'user_id' => '2',
                'is_creator' => '1',
                'is_applied' => '0'
              ],
              [
                'job_id' => '3',
                'user_id' => '2',
                'is_creator' => '1',
                'is_applied' => '0'
              ],
              [
                'job_id' => '2',
                'user_id' => '4',
                'is_creator' => '0',
                'is_applied' => '1',
              ],
              [
                'job_id' => '2',
                'user_id' => '3',
                'is_creator' => '0',
                'is_applied' => '1',
              ],
              [
                'job_id' => '2',
                'user_id' => '5',
                'is_creator' => '0',
                'is_applied' => '1',
              ],
              [
                'job_id' => '5',
                'user_id' => '4',
                'is_creator' => '1',
                'is_applied' => '0'
              ],
              [
                'job_id' => '1',
                'user_id' => '7',
                'is_creator' => '1',
                'is_applied' => '0'
              ],
              [
                'job_id' => '6',
                'user_id' => '10',
                'is_creator' => '1',
                'is_applied' => '0'
              ],
        ]);
    }
}
