<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// password: *ttn-super-admin#2020
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
         DB::table('users')->insert([
                   [
                     'role_id' => '1',
                     'user_type_id' => '',
                     'name' => 'Super Admin',
                     'email' => 'admin@gmail.com',
                     'phone' => '01977625353',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ],
                   [
                     'role_id' => '10',
                     'user_type_id' => '4',
                     'name' => 'Rion',
                     'email' => 'mdrsdrion@gmail.com',
                     'phone' => '01977625353',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ],
                   [
                     'role_id' => '10',
                     'user_type_id' => '1',
                     'name' => 'John Doe',
                     'email' => 'johndoe@gmail.com',
                     'phone' => '01977625353',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ],
                   [
                     'role_id' => '10',
                     'user_type_id' => '3',
                     'name' => 'Farhad',
                     'email' => 'farhad@gmail.com',
                     'phone' => '01977625353',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ],
                   [
                     'role_id' => '10',
                     'user_type_id' => '4',
                     'name' => 'Md. Ismail',
                     'email' => 'Ismail@gmail.com',
                     'phone' => '01977625353',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ],
                   [
                     'role_id' => '10',
                     'user_type_id' => '4',
                     'name' => 'Md Hasibuddin',
                     'email' => 'mdhasibuddin@gmail.com',
                     'phone' => '01977625353',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ],
                   [
                     'role_id' => '10',
                     'user_type_id' => '3',
                     'name' => 'Admin AhsanUllah Univesity',
                     'email' => 'adminaust@gmail.com',
                     'phone' => '01977625334',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ],
                   [
                     'role_id' => '10',
                     'user_type_id' => '4',
                     'name' => 'Admin RobinTex Group',
                     'email' => 'adminrobintexgroup@gmail.com',
                     'phone' => '01977625335',
                     'password' => '$2y$12$juFyOLk5tMm.4e/MXvsX..Lub4.MkAlEd0lg50jBzOzKjWnsGW5Ea',
                     'status' => '10',
                     'created_at' => now(),
                     'updated_at' => now()
                   ]
               ]);
              //  factory(App\Models\User::class, 3)->create();
     }
}
