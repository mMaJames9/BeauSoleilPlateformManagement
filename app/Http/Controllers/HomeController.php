<?php

namespace App\Http\Controllers;

use generateUniqueStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User;

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
public function getnumber($id)
{
   /*  $query = $request->get('query');
    $users = User::where('name','like','%'.$query.'%');
    $usersCount = $users->count();
    $users = $users->select('*')->take(all)->get();
    echo $usersCount;
    print_r($users);
    return view('home', compact('users')); */


}


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('clients')->count();
        $serv = DB::table('services')->count();
        $tick = DB::table('factures')->count();

        return view('home', compact('data', 'serv','tick'));
    }
}
