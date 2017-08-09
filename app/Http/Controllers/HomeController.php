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

      $tabs = array('', 'active', '', '');
      $tabs2 = array('', 'active2', '', '');

      return view('home', ['baggages' => $baggages, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function create(){
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);

      $tabs = array('active', '', '', '');
      $tabs2 = array('active2', '', '', '');

      return view('home', ['baggages' => $baggages, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function createSpecific($position){
      $rows = 10;
      $cols = 14;
      $med_col = $cols/2;

      $baggages = HomeController::getBaggages($rows, $cols);

      $tabs = array('active', '', '', '');
      $tabs2 = array('active2', '', '', '');

      return view('home', ['baggages' => $baggages, 'rows' => $rows, 'cols' => $cols, 'med_col' => $med_col, 'tabs' => $tabs, 'tabs2' => $tabs2]);
    }

    public function getBaggages($rows, $cols){
      $baggages = array();
      for($ini_row=0; $ini_row<$rows; $ini_row++){
        for($ini_col=0; $ini_col<$cols; $ini_col++){
          $founded = Position::ocupation(chr($ini_row+65), $ini_col);
          $baggages[$ini_row][$ini_col] = array(chr($ini_row+65), $ini_col, $founded);
        }
      }
      return $baggages;
    }
}
