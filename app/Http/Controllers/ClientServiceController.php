<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientService;
use App\Service;
use App\Facture;
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

        $factures = ClientService::all();

        return view('tickets.index', compact('factures'));
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
        $date = Carbon::now()->format('d-m-Y');

        $datas = array('random', 'date');

        return view('tickets.create', compact($datas));
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

        // dd($request);

        $client->tickets()->sync($request->input('tickets', []));

        foreach ($request->createTickets as $facture) {
            $client->services()->sync(
                $facture ['service_id'], [

                    'quantity' => $facture['quantity'],
                ],
            );
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
    public function edit(ClientService $ticket)
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
        DB::table('client_service_ticket')->where('id', $id)->delete();

        // get list of all transactions of tickets
        // DB::table('hold')->where('id', $id)->delete();

        $status = 'The ticket was deleted successfully.';

        return redirect()->route('tickets.index')->with([
            'status' => $status,
        ]);
    }
}
