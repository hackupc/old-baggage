<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      DB::table('users')->insert([
        'username' => 'volunteer',
        'name' => 'Volunteer',
        'email' => 'volunteer@hackupc.com',
        'password' => bcrypt('volunteer'),
      ]);
    }
}
