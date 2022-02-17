<?php

namespace App\Http\Controllers;

use DB;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            return Datatables::eloquent(Role::query())->make(true);
        }
        $permissions = Permission::get();
        return view('admin.roles.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'name' => 'required |string',
            ]);

            $role= new Role;
            $role->name = $request->name;
            $role->syncPermissions($request->permissions);
            $role->save();
            return ['code'=>'200','message'=>'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code'=>'422','errors' => $e->errors()];
            }
            else{
                return ['code'=>'500','error_message'=>$e->getMessage()];
            }
        } 
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
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->pluck('permission_id');
        return response()->json(['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'name' => 'required |string'
            ]);

            $role=Role::find($id);
            $role->name = $request->name;
            $role->syncPermissions($request->permissions);
            $role->save();
            return ['code'=>'200','message'=>'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code'=>'422','errors' => $e->errors()];
            }
            else{
                return ['code'=>'500','error_message'=>$e->getMessage()];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $role = Role::find($id);
            DB::table('role_has_permissions')->where('role_id', $role->id)->delete();
            $role->delete();
            return ['code'=>'200','message'=>'success'];
        }
        catch(\Exception $e){
            return ['code'=>'500','error_message'=>$e->getMessage()];
        }
    }
}
