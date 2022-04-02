<?php

namespace App\Http\Controllers;

use generateUniqueStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\CarbonPeriod;

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
public function getnumber($id){

    $count = DB::table('services')->count();

    if($count > 0) {

         //more than one raw
    }
    return view('home', compact('count'));
}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
