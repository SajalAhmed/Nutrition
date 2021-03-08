<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ReviewQuestionSeeder::class);
        // $this->call(ReviewQuestionAnswerSeeder::class);
        // $this->call(DistrictTableSeeder::class);
        $this->call(UpazillaTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        //  $this->call(RolesTableSeeder::class);
    }
}
