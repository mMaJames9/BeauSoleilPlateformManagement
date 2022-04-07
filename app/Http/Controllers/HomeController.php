<?php

namespace App\Http\Controllers;

use App\Client;
use generateUniqueStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User;
use App\Facture;
use App\Service;
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
        $data = Client::where('created_at', '>',now()->subMonth(1))->count();
        $serv = Service::all()->count();
        $tick = Facture::where('created_at', '>',now()->subMonth(1))->count();
        $datas = array('random', 'date');
        $fact= Facture::where('created_at', '>',now()->subMonth(1))->sum('total_price');

        // $factures= Facture::where('total_price')->withSum(['getTotalPrice'=>function($query){
        //         $query->where('created_at', '>',now()->subMonth(1));
        //     }],'price_service')

        // ->get();


        return view('home', compact('data', 'serv','tick', 'fact'));
    }
}
