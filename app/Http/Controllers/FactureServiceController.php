<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use App\Client;
use App\FactureService;
use App\Facture ;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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
    public function create()
    {
        // abort_if(Gate::denies('facture_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all();

        $random = strtoupper(Str::random(6));
        $date = Carbon::now()->format('d-m-Y');

        $datas = array('random', 'date');

        return view('factures.create', compact($datas, 'clients'));
    }

    // public function PrintData()
    // {
    //     $printd =Facture::all()->pluck( 'client_id', 'service_id','total_price', 'created_at');
    //     // $connector = new FilePrintConnector('/dev/usb/lp0', 'w');
    //     // $printer = new Printer($connector);
    //     $printer -> text($printd);
    //     $printer -> cut();
    //     $printer -> close();

    //     return view('factures.PrintData', compact('printer'));
    // }
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
            'service_id' => ['required'],
            'quantity' => ['required', 'numeric', 'min:1']
        ]);

        $facture = Facture::create($request->all());

        $facture->client()->sync($request->input('clients', []));

        foreach ($request->facture as $facture) {
            $facture->services()->sync($facture ['service_id'], ['quantity' => $facture['quantity']]);
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
        DB::table('client_service')->where('id', $id)->delete();

        // get list of all transactions of factures
        // DB::table('hold')->where('id', $id)->delete();

        $status = 'The facture was deleted successfully.';

        return redirect()->route('factures.index')->with([
            'status' => $status,
        ]);
    }
}
