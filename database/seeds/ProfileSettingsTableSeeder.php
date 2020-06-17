<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProfileSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('profile_settings')->insert([
            [
              'setting_name' => 'CoverPic',
              'description' => 'Controll your cover picture visibility',
              'setting_code' => 'cover_pic',
              'status' => '20',
            ],
            [
              'setting_name' => 'Community',
              'description' => 'Controll your community visibility',
              'setting_code' => 'community',
              'status' => '20',
            ],
            [
              'setting_name' => 'ProfilePic',
              'description' => 'Controll your profile picture visibility',
              'setting_code' => 'profile_pic',
              'status' => '20',
            ],
            [
              'setting_name' => 'Solial Link',
              'description' => 'Controll your social link visibility',
              'setting_code' => 'social_link',
              'status' => '10',
            ],           
            [
              'setting_name' => 'Contact',
              'description' => 'Controll your contact info visibility',
              'setting_code' => 'contact',
              'status' => '20',
            ],           
            [
              'setting_name' => 'Education',
              'description' => 'Controll your education visibility',
              'setting_code' => 'education',
              'status' => '20',
            ],           
            [
              'setting_name' => 'Experience',
              'description' => 'Controll your experience visibility',
              'setting_code' => 'experience',
              'status' => '20',
            ],           
            [
              'setting_name' => 'Skill',
              'description' => 'Controll your skill visibility',
              'setting_code' => 'skill',
              'status' => '20',
            ],           
            [
              'setting_name' => 'Location',
              'description' => 'Controll your location visibility',
              'setting_code' => 'location',
              'status' => '0',
            ],           
            [
              'setting_name' => 'About yourself',
              'description' => 'Controll your about yourself visibility',
              'setting_code' => 'about_yourself',
              'status' => '20',
            ],           
        ]);
    }
}