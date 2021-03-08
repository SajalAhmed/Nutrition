<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = array(
            // array('name_en' => 'Upazila Secondary Education Officer','name_bn' => 'উপজেলা মাধ্যমিক শিক্ষা অফিসার'),
            // array('name_en' => 'Health Inspector &  Asst. Health Inspector','name_bn' => 'স্বাস্থ্য পরিদর্শক এবং সহকারী স্বাস্থ্য পরিদর্শক'),
            // array('name_en' => 'Head Master','name_bn' => 'প্রধান শিক্ষক'),
            // array('name_en' => 'Thana Education Officer','name_bn' => 'থানা শিক্ষা অফিসার'),
            // array('name_en' => 'Senior / Junior District Health Education Officer','name_bn' => 'সিনিয়র/জুনিয়র জেলা স্বাস্থ্য শিক্ষা অফিসার'),
            // array('name_en' => 'Guide teacher','name_bn' => 'গাইড শিক্ষক'),
            // array('name_en' => 'Upazila Academic Supervisor','name_bn' => 'উপজেলা একাডেমিক সুপারভাইজার'),
            // array('name_en' => 'Health assistant and sub-assistant community','name_bn' => 'স্বাস্থ্য সহকারী এবং উপ-সহকারী কমিউনিটি'),
            // array('name_en' => 'Medical Officer / Family Welfare Assistant','name_bn' => 'মেডিকেল অফিসার/পরিবার কল্যাণ সহকারী'),
            // array('name_en' => 'Club Facilitator','name_bn' => 'ক্লাব ফ্যাসিলিটেটর'),
            // array('name_en' => 'Club leader','name_bn' => 'ক্লাব লিডার'),
            // array('name_en' => 'Member of the Adolescent Club','name_bn' => 'কিশোরকিশোরী ক্লাবের সদস্য'),
            // array('name_en' => 'Other','name_bn' => 'অনান্য'),
            array('name_en' => 'জেলা শিক্ষা অফিসার','name_bn' => 'জেলা শিক্ষা অফিসার'),
            array('name_en' => 'জেলা প্রশিক্ষণ সমন্বয়কারী','name_bn' => 'জেলা প্রশিক্ষণ সমন্বয়কারী'),
            array('name_en' => 'উপ-পরিচালক পরিবার পরিকল্পনা','name_bn' => 'উপ-পরিচালক পরিবার পরিকল্পনা'),
            array('name_en' => 'উপ-পরিচালক শিক্ষা','name_bn' => 'উপ-পরিচালক শিক্ষা'),
            array('name_en' => 'থানা মাধ্যমিক শিক্ষা অফিসার','name_bn' => 'থানা মাধ্যমিক শিক্ষা অফিসার'),
          );
          //DB::table('designations')->truncate();
          DB::table('designations')->insert($designations);
    }
}
