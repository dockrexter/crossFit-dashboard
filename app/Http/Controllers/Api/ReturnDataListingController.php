<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use App\Models\WorkoutsOfDay;
use App\Http\Controllers\Controller;

class ReturnDataListingController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function timetables()
    {
        try{
            $time_tables = TimeTable::all();
            return ['code'=>'200','message'=>'success','time_tables'=>$time_tables];
        }
        catch(\Exception $e){
            return ['code'=>'500','error_message'=>$e->getMessage()];
        } 
    }
}
