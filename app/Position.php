<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public static function current(){
      return \DB::select('select pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description from positions pos where pos.deleted is null order by pos.row, pos.col');
    }

    public static function current_specials(){
      return \DB::select('select pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description from positions pos where pos.row = "@" and pos.deleted is null order by pos.row, pos.col');
    }

    public static function current_notspecials(){
      return \DB::select('select pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description from positions pos where pos.row <> "@" and pos.deleted is null order by pos.row, pos.col');
    }

    public static function old(){
      return \DB::select('select pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.deleted, pos.description from positions pos where pos.deleted is not null order by pos.row, pos.col');
    }

    public static function user($id){
      return \DB::table('positions')->select('id', 'name', 'surname')->where([['id', $id]])->get();
    }

    public static function user_specific($id){
      return \DB::table('positions')->select('*')->where([['id', $id]])->orderBy('deleted', 'asc')->orderBy('created', 'asc')->get();
    }

    public static function specific($ini_row, $ini_col){
      return \DB::table('positions')->select('*')->where([['row', $ini_row], ['col', $ini_col]])->get();
    }

    public static function ocupation($ini_row, $ini_col){
      return \DB::table('positions')->select('*')->where([['row', $ini_row], ['col', $ini_col], ['deleted', NULL]])->get();
    }

    public static function register($reg_row, $reg_col, $reg_id, $reg_name, $reg_surname, $reg_desc){
      return \DB::insert('insert into positions (row, col, id, name, surname, created, deleted, description) values (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, NULL, ?)', [$reg_row, $reg_col, $reg_id, $reg_name, $reg_surname, $reg_desc]);
    }

    public static function baggage($created, $ini_row, $ini_col){
      return \DB::table('positions')->select('*')->where([['row', $ini_row], ['col', $ini_col], ['created', $created]])->get();
    }

    public static function deleteSpecific($id0, $id1){
      return \DB::update('update positions set deleted = CURRENT_TIMESTAMP where row = ? and col = ?', [$id0, $id1]);
    }
}
