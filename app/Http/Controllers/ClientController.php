<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->sortByDesc("created_at");

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $clients = Client::all();
        $date = Carbon::now()->format('d-m-Y');

        $datac = array('date', 'clients');

        return view('clients.create', compact($datac) );
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
            'phone_number' => ['required', 'numeric', 'min:9', ],
        ]);

        $client = Client::create($request->all());

        $status = 'A new client was created successfully.';

        return redirect()->route('clients.index')->with([
            'status' => $status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        // abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //delete the clients
        DB::table('clients')->where('id', $id)->delete();

        // get list of all transactions of clients
        // DB::table('hold')->where('id', $id)->delete();

        $status = 'The client was deleted successfully.';

        return redirect()->route('clients.index')->with([
            'status' => $status,
        ]);
    }
}
