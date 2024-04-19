<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use DB;

class MasterController extends Controller
{
    private $locationTable;
    public function __construct(){
         $this->locationTable=DB::table('location');
    }
    public function index()
    {
        $location = $this->locationTable->first();
        return view('admin.location', compact('location'));
    }

  public function updateLocation(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'latitude' => 'required', 
            'minDistance' => 'required', 
            'longitude' => 'required', 
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $location = $this->locationTable->where('id',$request->id)->update([
                                        'latitude' =>$request->latitude, 
                                        'minDistance' =>$request->minDistance, 
                                        'longitude' =>$request->longitude, 
                                        ]);
       if($location){
           return response()->json(['status'=>'success' , 'message'=>'update location successfully'], 200);
       }
        
    }

}
