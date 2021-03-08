<?php

use Illuminate\Database\Seeder;

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
            'name' => Str::random(10),
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'phone' =>"012584125412",
            'password' => Hash::make('1234'),
        ]);
    }
}
