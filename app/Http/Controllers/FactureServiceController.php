<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';

use App\Category;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use App\Client;
use App\FactureService;
use App\Facture ;
use App\Http\Livewire\Services;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class FactureServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function findPriceService(Request $request)
    {
        $p = Service::select('price_service')->where('id', $request->id)->first();
        return response()->json($p);
    }

    public function index()
    {
        // abort_if(Gate::denies('facture_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $factures = Facture::with('client')->get();



        // $factures = Facture::with('services')->get();

        // dd($factures->client);


        return view('factures.index', compact( 'factures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Services $services)
    {
        // abort_if(Gate::denies('facture_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all();

        $services = Service::all();
        $categories = Category::all();

        $random = strtoupper(Str::random(6));
        $date = Carbon::now()->format('d-m-Y');
        // $datac = DB::table("services")
	    // ->select(DB::raw("SUM(price_service) as count"))
	    // ->orderBy("created_at")
	    // ->groupBy(DB::raw("created_at"))
	    // ->get();
        $balance = DB::table('services')->where('id')->sum('Price_service');

        $datas = array('random', 'date', 'services', 'categories');


        // foreach($sum as $facture){
        //     $facture->items = 0;
        //     foreach($facture->services as $service ){
        //         $facture->items += $service->pivot->quantity;

        //     }

        // }

        return view('factures.create', compact($datas, 'clients', 'balance'));
    }

    public function PrintData()
    {
        $printd =Facture::all()->pluck( 'client_id', 'service_id','total_price', 'created_at');

        $connector = new WindowsPrintConnector(" ");;
        $printer = new Printer($connector);
        $printer -> text($printd);
        $printer -> cut();
        $printer -> close();


        return view('factures.PrintData', compact('printer'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name_client' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'min:620000000', 'max:699999999'],
            'num_ticket' => ['required', 'string', 'min:6', 'max:6', Rule::unique('factures')],
            'total_price' => ['required', 'numeric'],
        ]);


        $facture = Facture::create($request->all());



        foreach ($request->factureDetails as $factureDetail) {
            $factureDetail->services()->attach($factureDetail['service_id'],
            ['quantity' => $factureDetail['quantity']]);
        }



        $status = 'A new facture was created successfully.';


        return redirect()->route('factures.index')->with([
            'status' => $status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FactureService  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(FactureService $facture)
    {
        // abort_if(Gate::denies('facture_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facture->load('clients','services');

        return view('factures.show', compact('facture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FactureService  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FactureService  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FactureService $facture)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FactureService  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_if(Gate::denies('facture_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //delete the factures
        DB::table('factures')->where('id', $id)->delete();

        // get list of all transactions of factures
        // DB::table('hold')->where('id', $id)->delete();

        $status = 'The facture was deleted successfully.';

        return redirect()->route('factures.index')->with([
            'status' => $status,
        ]);
    }
}
