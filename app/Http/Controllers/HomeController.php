<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Position;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      //$baggages = Position::current();
      //$baggages = json_decode( json_encode($baggages), true);
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);
      $lists = Position::current();
      $lists = json_decode( json_encode($lists), true);
      $specials = Position::current_specials();
      $specials = json_decode( json_encode($specials), true);

      $tabs = array('', 'active', '', '');
      $tabs2 = array(false, true, false, false, false, false);

      return view('home', ['baggages' => $baggages, 'specials' => $specials, 'lists' => $lists, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function indexSpecific($created, $position){
      //$baggages = Position::current();
      //$baggages = json_decode( json_encode($baggages), true);
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $created = date('Y-m-d H:i:s', $created);

      $baggages = HomeController::getBaggages($rows, $cols);

      $newposition = array(substr($position, 0, 1), substr($position, 1));
      $list = Position::baggage($created, $newposition[0], $newposition[1]);
      $list = json_decode( json_encode($list), true);
      $specials = Position::current_specials();
      $specials = json_decode( json_encode($specials), true);

      $tabs = array('', '', '', '');
      $tabs2 = array(false, false, false, false, true, false);

      return view('home', ['baggages' => $baggages, 'specials' => $specials, 'newposition' => $newposition, 'list' => $list, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function oldSpecific($id, $position){
      //$baggages = Position::current();
      //$baggages = json_decode( json_encode($baggages), true);
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);

      $newposition = array(substr($position, 0, 1), substr($position, 1));
      $list = Position::specific($newposition[0], $newposition[1]);
      $list = json_decode( json_encode($list), true);
      $list = $list[0];
      $specials = Position::current_specials();
      $specials = json_decode( json_encode($specials), true);

      $tabs = array('', '', '', '');
      $tabs2 = array(false, false, false, false, true, false);

      return view('home', ['baggages' => $baggages, 'specials' => $specials, 'newposition' => $newposition, 'list' => $list, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function userSpecific($id){
      //$baggages = Position::current();
      //$baggages = json_decode( json_encode($baggages), true);
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);
      $user = Position::user($id);
      $user = json_decode( json_encode($user), true);
      $lists = Position::user_specific($id);
      $lists = json_decode( json_encode($lists), true);
      $specials = Position::current_specials();
      $specials = json_decode( json_encode($specials), true);

      $tabs = array('', '', '', '');
      $tabs2 = array(false, false, false, false, false, true);

      return view('home', ['baggages' => $baggages, 'specials' => $specials, 'user' => $user, 'lists' => $lists, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function create(){
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);
      $lists = Position::current();
      $lists = json_decode( json_encode($lists), true);
      $specials = Position::current_specials();
      $specials = json_decode( json_encode($specials), true);

      $tabs = array('active', '', '', '');
      $tabs2 = array(true, false, false, false, false, false);

      return view('home', ['baggages' => $baggages, 'specials' => $specials, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function createSpecific($position){
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);
      $specials = Position::current_specials();
      $specials = json_decode( json_encode($specials), true);

      $newposition = array(substr($position, 0, 1), substr($position, 1));

      $tabs = array('active', '', '', '');
      $tabs2 = array(true, false, false, false, false, false);

      return view('home', ['baggages' => $baggages, 'specials' => $specials, 'newposition' => $newposition, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function registerSpecific($id, $name, $surname, $desc, $spe){
      if($spe=="true"){
        $places = Position::current_specials();
        $places = json_decode( json_encode($places), true);

        $founded=false;
        $size=sizeof($places);
        $pos=0;
        $pos2=0;
        $def_row = '@';
        while((!$founded)&&($pos<$size)){
          if($pos!=$places[$pos]["col"]){
            $founded = true;
            $def_col = $pos;
          }
          if($pos==$places[$pos2]["col"]){
            $pos2++;
          }
          $pos++;
        }
        if(!$founded){
          $def_col = $pos;
        }
      }
      else{
        $places = Position::current_notspecials();
        $places = json_decode( json_encode($places), true);

        $rows = 10;
        $cols = 14;
        $rows_i = 0;
        $cols_i = 0;
        $places_org = array();
        while($rows_i<$rows){
          while($cols_i<$cols){
            $places_org[] = array("row"=>chr($rows_i+65), "col"=>$cols_i);
            $cols_i++;
          }
          $cols_i = 0;
          $rows_i++;
        }
        $founded=false;
        $def_row=NULL;
        $def_col=NULL;
        $size=sizeof($places);
        $size_org=sizeof($places_org);
        $pos=0;
        $pos_org=0;
        while((!$founded)&&($pos_org<$size_org)){
          if(($pos<$size)&&($places_org[$pos_org]["row"]==$places[$pos]["row"])&&($places_org[$pos_org]["col"]==$places[$pos]["col"])){
            $pos++;
          }
          else{
            $founded = true;
            $def_row = $places_org[$pos_org]["row"];
            $def_col = $places_org[$pos_org]["col"];
          }
          $pos_org++;
        }
      }

      $reg_row = $def_row;
      $reg_col = $def_col;
      $reg_id = $id;
      $reg_name = $name;
      $reg_surname = $surname;
      $reg_desc = $desc;

      Position::register($reg_row, $reg_col, $reg_id, $reg_name, $reg_surname, $reg_desc);

      return redirect("/user"."/".$reg_id."/".$reg_row.$reg_col);
    }

    public function history(){
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);
      $lists = Position::old();
      $lists = json_decode( json_encode($lists), true);
      $specials = Position::current_specials();
      $specials = json_decode( json_encode($specials), true);

      $tabs = array('', '', 'active', '');
      $tabs2 = array(false, false, true, false, false, false);

      return view('home', ['baggages' => $baggages, 'specials' => $specials, 'lists' => $lists, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function search(){
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);
      $specials = Position::current_specials();
      $specials = json_decode( json_encode($specials), true);

      $tabs = array('', '', '', 'active');
      $tabs2 = array(false, false, false, true, false, false);

      return view('home', ['baggages' => $baggages, 'specials' => $specials, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function getBaggages($rows, $cols){
      $baggages = array();
      for($ini_row=0; $ini_row<$rows; $ini_row++){
        for($ini_col=0; $ini_col<$cols; $ini_col++){
          $founded = Position::ocupation(chr($ini_row+65), $ini_col);
          $founded = json_decode( json_encode($founded), true);
          $baggages[$ini_row][$ini_col] = array(chr($ini_row+65), $ini_col, $founded);
        }
      }
      return $baggages;
    }
}
