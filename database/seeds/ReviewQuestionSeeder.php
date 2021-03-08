<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = array(
            array('title_en' =>'How was your experience with this course?','title_bn' => 'এই কোর্সের সাথে আপনার অভিজ্ঞতা কেমন ছিল?'),
            array('title_en' =>'The objectives of this course were clear:','title_bn' => 'এই কোর্সটির উদ্দেশ্যগুলি পরিষ্কার ছিল :'),
            array('title_en' =>'I have learned the instructive subjects from the course','title_bn' => 'কোর্সটি থেকে শিক্ষণীয় বিষয়গুলি  জানতে পেরেছি'),
            array('title_en' =>'The course is relevant to my work','title_bn' => 'কোর্সটি আমার কাজের ক্ষেত্রে প্রাসঙ্গিক / প্রযোজ্য'),
            array('title_en' =>'Would you tell your co-workers or friends about this course?','title_bn' => 'আপনি কি আপনার সহকর্মীদের বা বন্ধুদের এই কোর্সটি সম্পর্কে জানাবেন ?'),
          );
          DB::table('review_questions')->truncate();
          DB::table('review_questions')->insert($question);
    }
}
