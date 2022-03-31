<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all() ->pluck ('label_permission', 'id');

        return view('roles.create', compact('permissions'));
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
            'label_role' => ['required', 'string', 'max:255', 'unique:roles', Rule::unique('roles')],
            'permissions[]' => ['required', 'string'],
        ]);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        $status = 'A new role was created successfully.';

        return redirect()->route('roles.index')->with([
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role)
    {
        $permissions = Permission::all()->pluck('label_permission', 'id');

        $role->load('permissions');

        return view('roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role)
    {
        $this->validate($request, [
            'label_role' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role),]
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        $status = 'The role was updated successfully.';

        return redirect()->route('roles.index')->with([
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

        DB::table('roles')->where('id_role', $id)->delete();
        $status = 'The role was deleted successfully.';

        return redirect()->route('roles.index')->with([
            'status' => $status,
        ]);
    }
}
