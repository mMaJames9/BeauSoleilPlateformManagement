<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';

use App\Category;
use Exception;
use App\Client;
use App\FactureService;
use App\Facture ;
use App\Http\Livewire\Services;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Yajra\DataTables\DataTables;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Mike42\Escpos\CapabilityProfile;



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

        $factures = Facture::with('client')->orderBy('created_at', 'desc')->get();

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

        $clients = Client::all()->sortByDesc("created_at");

        $services = Service::all()->sortByDesc("created_at");
        $categories = Category::all()->sortByDesc("created_at");

        $random = strtoupper(Str::random(6));
        $date = Carbon::now()->format('d-m-Y');
        $balance = DB::table('services')->where('id')->sum('Price_service');

        $datas = array('random', 'date', 'services', 'categories');

        return view('factures.create', compact($datas, 'clients'));
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

        $client = Client::create([
            'name_client' => $request->input('name_client'),
            'phone_number' => $request->input('phone_number'),
        ]);

        $facture = Facture::create([
            'client_id' => $client->id,
           'num_ticket' => $request->input('num_ticket'),
           'total_price' => $request->input('total_price'),
        ]);

        $facture->services()->sync($request->input('services', []));

        // dd($facture);
        $connector = new WindowsPrintConnector("epson U220");
            $printer = new Printer($connector);
            $data = json_encode(array('num_facture', 'name_client', 'phone_number', 'created_at', 'label_service', 'price_service', 'total_price'));

            $printer->initialize();
            $printer->text($data . "\n");
            $printer->selectPrintMode(Printer::MODE_UNDERLINE);

            $printer -> cut();

            $printer -> close();

        $status = 'La nouvelle facture a été ajouté avec succès';


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
    public function show(FactureService $facture,Request $r)
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

        $status = 'Cette facture a été supprimé avec succès';

        return redirect()->route('factures.index')->with([
            'status' => $status,
        ]);
    }
}
