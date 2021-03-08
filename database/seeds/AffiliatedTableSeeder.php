<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffiliatedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $affiliateds = array(
            array('name_en' => 'A Government entity','name_bn' => 'সরকারি  প্রতিষ্ঠান '),
            array('name_en' => 'An NGO','name_bn' => 'এনজিও'),
            array('name_en' => 'An educational institution','name_bn' => 'শিক্ষা প্রতিষ্ঠান'),
            array('name_en' => 'UN entity','name_bn' => 'ইউএন'),
            array('name_en' => 'Community club','name_bn' => 'কমিউনিটি ক্লাব'),
            array('name_en' => 'Other / Non-Affiliated','name_bn' => 'অন্যান্য / অননুমোদিত'),
          );
          DB::table('affiliateds')->truncate();
          DB::table('affiliateds')->insert($affiliateds);
    }
}
