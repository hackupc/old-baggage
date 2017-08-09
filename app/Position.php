<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{    
    public static function current(){
      return \DB::select('select pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description from positions pos where pos.deleted is null order by pos.row, pos.col');
    }

    public static function current_specials(){
      return \DB::select('select pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description from positions pos where pos.deleted is null order by pos.row, pos.col');
    }

    public static function ocupation($ini_row, $ini_col){
      return \DB::table('positions')->select('*')->where([['row', $ini_row], ['col', $ini_col], ['deleted', NULL]])->get();
    }
}
