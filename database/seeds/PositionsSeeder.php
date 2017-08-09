<?php

use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      DB::table('positions')->insert([
        'row' => 'A',
        'col' => 1,
        'id' => '74294850Y',
        'name' => 'David',
        'surname' => 'Mateu Vallirana',
        'created' => '2017-08-09 07:01:45',
        'deleted' => NULL,
        'description' => 'Black bag with a Lenovo laptop inside.'
      ]);
      DB::table('positions')->insert([
        'row' => 'A',
        'col' => 2,
        'id' => '74294850Y',
        'name' => 'David',
        'surname' => 'Mateu Vallirana',
        'created' => '2017-08-09 07:02:13',
        'deleted' => NULL,
        'description' => 'Camping stuff.'
      ]);
      DB::table('positions')->insert([
        'row' => 'A',
        'col' => 3,
        'id' => '45352342J',
        'name' => 'Mireia',
        'surname' => 'Casas Subirats',
        'created' => '2017-08-09 07:03:13',
        'deleted' => '2017-08-09 10:17:56',
        'description' => 'Sleeping bag.'
      ]);
      DB::table('positions')->insert([
        'row' => 'A',
        'col' => 4,
        'id' => '45352342J',
        'name' => 'Mireia',
        'surname' => 'Casas Subirats',
        'created' => '2017-08-09 07:03:57',
        'deleted' => NULL,
        'description' => 'Big blue bag with Samsung tablet and Toshiba laptop inside.'
      ]);
      DB::table('positions')->insert([
        'row' => '@',
        'col' => 0,
        'id' => '34968100A',
        'name' => 'Elena',
        'surname' => 'Llobera Vila',
        'created' => '2017-08-09 08:23:01',
        'deleted' => NULL,
        'description' => 'Oscilloscope.'
      ]);
    }
}
