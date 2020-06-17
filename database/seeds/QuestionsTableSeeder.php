<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'created_by' => '1',
                'question_category_id' => '1',
                'title' => 'What are the types Of washing faults?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'is_ticket' => '0',
                'ticket_status' => '',
                'created_at' => now()
            ],  
            [
                'created_by' => '3',
                'question_category_id' => '4',
                'title' => 'Which chemical cre used in washing plant?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'is_ticket' => '0',
                'ticket_status' => '',
                'created_at' => now()
            ], 
            [
                'created_by' => '2',
                'question_category_id' => '5',
                'title' => 'Which machines are used in washing plant?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'is_ticket' => '0',
                'ticket_status' => '',
                'created_at' => now()
            ], 
            [
                'created_by' => '2',
                'question_category_id' => '2',
                'title' => 'What are the purpose of washing?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'is_ticket' => '0',
                'ticket_status' => '',
                'created_at' => now()
            ], 
            [
                'created_by' => '3',
                'question_category_id' => '7',
                'title' => 'Why Polyester garments can not be dyed by mere mortals?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '32',
                'status' => '10',
                'is_ticket' => '0',
                'ticket_status' => '',
                'created_at' => now()
            ],    
            [
                'created_by' => '3',
                'question_category_id' => '3',
                'title' => 'How to choose a sewing machine',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '2',
                'status' => '10',
                'is_ticket' => '0',
                'ticket_status' => '',
                'created_at' => now()
            ],    
            [
                'created_by' => '1',
                'question_category_id' => '3',
                'title' => 'What is a mechanical or an electrical model?',
                'details' => 'Color shade variation Crease marks After wash hole Very dark and very light Bleach spot Bottom hem and course edge destroy Bad smell due to poor.',
                'up_vote' => '23',
                'down_vote' => '12',
                'total_answer' => '4',
                'total_view' => '2',
                'status' => '10',
                'is_ticket' => '0',
                'ticket_status' => '',
                'created_at' => now()
            ],
            [
                'created_by' => '8',
                'question_category_id' => '4',
                'title' => 'I cant invite other to my event',
                'details' => 'I created an event and wish to send invitation to others but I can not. Why?',
                'up_vote' => '0',
                'down_vote' => '0',
                'total_answer' => '4',
                'total_view' => '0',
                'status' => '10',
                'is_ticket' => '1',
                'ticket_status' => '10',
                'created_at' => now()
            ],
            [
                'created_by' => '9',
                'question_category_id' => '4',
                'title' => 'My wish to post job',
                'details' => 'I wish to post a job but I see no way to create a job post. Please help! Thanks',
                'up_vote' => '0',
                'down_vote' => '0',
                'total_answer' => '4',
                'total_view' => '0',
                'status' => '10',
                'is_ticket' => '1',
                'ticket_status' => '10',
                'created_at' => now()
            ],         

        ]);
    }
}
