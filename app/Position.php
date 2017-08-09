<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public static function current(){
      return \DB::select('select pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description from hupc_positions pos where pos.deleted is null order by pos.row, pos.col');
    }

    public static function ocupation(){
      return \DB::select('select pos.row, pos.col, pos.id from hupc_positions pos');
    }
}
