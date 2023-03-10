<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Arr;

use App\Models\SellerModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //

    public function index() {
    
         
        $customers = CustomerModel::all();
     $data_have=[

        'status'=>200,
        'msg'=>$customers
     ];
     $nodata=[

        'status'=>404,
        'msg'=>'no record fund'
     ];

     if($customers->count()>0){
        return response()->json($data_have,200);
     }

     else {

        return response()->json($nodata,404);

     }

   

     
    }

    public function store(Request $request)
    
    {
     $validator=Validator::make($request->all(),[
        // 'cid'=>'0',
        'cus_code'=>'required|string|max:50',
        'cus_name'=>'required|string|max:50',
        'cus_address'=>'required|string|max:255',
        'cus_contact'=>'required|string|max:20',
        'created_at'=>'required|date',
        'updated_at'=>'required|date',
        'created_by'=>'required|integer'

      ]);

      if($validator->fails()){


        return response()->json([
            'status' =>422,
            'error'=>$validator->messages()
        ],422);

        

      }

      else {
        $customers=CustomerModel::create([
            'cid'=>$request->cid,
            'cus_code'=>$request->cus_code,
            'cus_name'=>$request->cus_name,
            'cus_address'=>$request->cus_address,
            'cus_contact'=>$request->cus_contact,
            'created_at'=>$request->created_at,
            'updated_at'=>$request->updated_at,
            'created_by'=>$request->userid,
        ]);

        if($customers){

            return response()->json([
                'status'=>200,
                'msg'=>"Created customer successfully"
            ],200);
        }
        else {
            return response()->json([
                'status'=>500,
                'msg'=>"Something wrong!"
            ],500);

        }
      }
      


    }


    public function show($id){

        $customers=CustomerModel::find($id);


        if ($customers){

            return response()->json([
                'status'=>200,
                'customers'=>$customers
            ],200);
        }

        else {

            return response()->json([
                'status'=>404,
                'msg'=>"No customer found!"
            ],404);

        }

    }

    public function edit($id){

        $customers=CustomerModel::find($id);
        if ($customers){

            return response()->json([
                'status'=>200,
                'customers'=>$customers
            ],200);
        }

        else {

            return response()->json([
                'status'=>404,
                'msg'=>"No customer found!"
            ],404);

        }
    }

    public function update(Request $request, int $id){

        $validator=Validator::make($request->all(),[
            // 'cid'=>'',
            'cus_code'=>'required',
            'cus_name'=>'required',
            'cus_address'=>'required',
            'cus_contact'=>'required',
            'created_at'=>'required',
            'updated_at'=>'required',
            'userid'=>'required|integer'
    
          ]);
    
          if($validator->fails()){
    
    
            return response()->json([
                'status' =>422,
                'error'=>$validator->messages()
            ],422);
    
            
    
          }
    
          else {

            $customers=CustomerModel::find($id);
            if($customers){
        
    
                $customers->update([
                    // 'cid'=>$request->cid,
                    'cus_code'=>$request->cus_code,
                    'cus_name'=>$request->cus_name,
                    'cus_address'=>$request->cus_address,
                    'cus_contact'=>$request->cus_contact,
                    'created_at'=>$request->created_at,
                    'updated_at'=>$request->updated_at,
                    'userid'=>$request->userid
                ]);
    
                return response()->json([
                    'status'=>200,
                    'msg'=>"Updated customer successfully"
                ],200);
            }
            else {
                return response()->json([
                    'status'=>404,
                    'msg'=>"Something wrong!"
                ],404);
    
            }
        }
          }
        
}




