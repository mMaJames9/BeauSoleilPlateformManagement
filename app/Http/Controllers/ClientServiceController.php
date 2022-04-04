<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use App\Client;
use App\ClientService;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ClientServiceController extends Controller
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
        // abort_if(Gate::denies('ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::with('services')
            ->groupBy()
            ->get();

        return view('tickets.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $random = strtoupper(Str::random(6));
        $date = Carbon::now()->format('m/d/y');

        $datas = array('random', 'date');

        return view('tickets.create', compact($datas));
    }

    public function PrintData()
    {
        $printd =ClientService::all()->pluck( 'client_id', 'service_id','num_ticket', 'created_at');
        $connector = new FilePrintConnector('/dev/usb/lp0', 'w');
        $printer = new Printer($connector);
        $printer -> text($printd);
        $printer -> cut();
        $printer -> close();
        return view('tickets.PrintData', compact('printer'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create($request->all());

        foreach ($request->createTickets as $ticket) {
            $client->services()->attach($ticket['service_id']);
            $client->services()->attach($ticket['num_ticket']);
        }

        $status = 'A new ticket was created successfully.';


        return redirect()->route('tickets.index')->with([
            'status' => $status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientService  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(ClientService $ticket)
    {
        // abort_if(Gate::denies('ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->load('clients','services');

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientService  $ticket
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
     * @param  \App\ClientService  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientService $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientService  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_if(Gate::denies('ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //delete the tickets
        DB::table('client_service')->where('id', $id)->delete();

        // get list of all transactions of tickets
        // DB::table('hold')->where('id', $id)->delete();

        $status = 'The ticket was deleted successfully.';

        return redirect()->route('tickets.index')->with([
            'status' => $status,
        ]);
    }
}
