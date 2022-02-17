<?php

namespace App\Http\Controllers;

use Hash;
use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
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
            return Datatables::eloquent(User::query())->make(true);
        }
        $roles = Role::get();
        return view('admin.users.index', compact('roles'));
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
                'name' => ['required', 'string', 'max:255', 'regex:^([a-zA-Z]+(.)?[\s]*)$^'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
                'phone_number' => ['required','numeric','digits_between:11,11'],
                'dob' => ['required', 'date'],
                'picture' => ['nullable', 'image'],
                'codice_fiscale' => ['nullable', 'file'],
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->dob = $request->dob;
            $user->picture = $request->picture;
            $user->codice_fiscale = $request->codice_fiscale;
            $user->save();
            $user->assignRole($request->role);
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
        $user = User::with('roles')->find($id);
        return response()->json($user);

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
                'name' => ['required', 'string', 'max:255', 'regex:^([a-zA-Z]+(.)?[\s]*)$^'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
                'password' => ['nullable', 'string', 'min:8', 'max:20', 'confirmed'],
                'phone_number' => ['required', 'numeric','digits_between:11,11'],
                'dob' => ['required', 'date'],
                'picture' => ['nullable', 'image'],
                'codice_fiscale' => ['nullable', 'file'],
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->dob = $request->dob;
            $user->picture = $request->picture;
            $user->codice_fiscale = $request->codice_fiscale;
            $user->save();
            $user->syncRoles($request->role);
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
        //
    }
}
