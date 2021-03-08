<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewQuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question_answer = array(
            array('review_question_id'=>1,'name_en' =>'Satisfactory','name_bn' => 'সন্তোষজনক'),
            array('review_question_id'=>1,'name_en' =>'Unsatisfactory','name_bn' => 'অসন্তোষজনক'),
            array('review_question_id'=>1,'name_en' =>'Good','name_bn' => 'ভাল'),
            array('review_question_id'=>1,'name_en' =>'Very Good','name_bn' => 'খুব ভাল'),
            array('review_question_id'=>1,'name_en' =>'Excellent','name_bn' => 'চমৎকার'),

            array('review_question_id'=>2,'name_en' =>'Disagree','name_bn' => 'অসম্মতি'),
            array('review_question_id'=>2,'name_en' =>'Agree','name_bn' => 'একমত'),
            array('review_question_id'=>2,'name_en' =>'No comments','name_bn' => 'কোন মন্তব্য নেই '),

            array('review_question_id'=>3,'name_en' =>'Disagree','name_bn' => 'অসম্মতি'),
            array('review_question_id'=>3,'name_en' =>'Agree','name_bn' => 'একমত'),
            array('review_question_id'=>3,'name_en' =>'No comments','name_bn' => 'কোন মন্তব্য নেই'),

            array('review_question_id'=>4,'name_en' =>'Disagree','name_bn' => 'অসম্মতি'),
            array('review_question_id'=>4,'name_en' =>'Agree','name_bn' => 'একমত'),
            array('review_question_id'=>4,'name_en' =>'No comments','name_bn' => 'কোন মন্তব্য নেই'),

            array('review_question_id'=>5,'name_en' =>'Yes','name_bn' => 'হ্যাঁ'),
            array('review_question_id'=>5,'name_en' =>'No','name_bn' => 'না'),
          );
          DB::table('review_question_answers')->truncate();
          DB::table('review_question_answers')->insert($question_answer);
        
    }
}
