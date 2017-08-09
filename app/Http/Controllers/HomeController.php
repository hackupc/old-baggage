<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
      $baggages = \DB::select('select pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description from positions pos where pos.deleted is null order by pos.row, pos.col');
      return view('home', ['baggages' => $baggages]);
    }
}
