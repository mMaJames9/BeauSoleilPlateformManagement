<?php

namespace App\Http\Controllers;

use App\Service;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MigrationsGenerator\Models\Model;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('label_category', 'id_category');

        return view('services.create', compact('categories'));
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
            'label_service' => ['required', 'string', 'max:255',Rule::unique('services')],
            'price_service' => ['required', 'numeric', 'min:0'],
        ]);

        $service = Service::create($request->all());

        $status = 'A new service was created successfully.';

        return redirect()->route('services.index')->with([
            'status' => $status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $services = Service::all();
      return view('services.index', compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($service)
    {
        $categories = Category::all()->pluck('label_category', 'id');

        $service->load('categories')->get();

        return view('services.edit', compact('categories', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service)
    {
        $this->validate($request, [
            'label_service' => ['required', 'string', 'max:255', Rule::unique('services')->ignore($service),],
            'price_service' => ['required', 'numeric', 'min:0'],
        ]);

        $service->update($request->all());

        $status = 'The service was updated successfully.';

        return redirect()->route('services.index')->with([
            'status' => $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('services')->where('id', $id)->delete();

        $status = 'The service was deleted successfully.';

        return redirect()->route('services.index')->with([
            'status' => $status,
        ]);
    }
}
