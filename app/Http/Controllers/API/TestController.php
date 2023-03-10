<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestModel;
use Illuminate\Support\Arr;

use App\Models\SellerModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    //

    public function index() {
    
         
        $tests = TestModel::all();
     $data_have=[

        'status'=>200,
        'msg'=>$tests
     ];
     $nodata=[

        'status'=>404,
        'msg'=>'no record fund'
     ];

     if($tests->count()>0){
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
        // 'id'=>'required|string|max:20',
        'tel'=>'required|string|max:20'
      

      ]);

      if($validator->fails()){


        return response()->json([
            'status' =>422,
            'error'=>$validator->messages()
        ],422);

        

      }

      else {
        $tests=TestModel::create([
            // 'cid'=>$request->cid,
            'id'=>$request->id,
            'tel'=>$request->tel,

        ]);

        if($tests){

            return response()->json([
                'status'=>200,
                'msg'=>"Created customer successfully"
            ],200);
        }
        else {
            return response()->json([
                'status'=>500,
                'msg'=>"Something wrong!"
            ],200);

        }
      }
      


    }


    public function show($id){

        $tests=TestModel::find($id);


        if ($tests){

            return response()->json([
                'status'=>200,
                'tests'=>$tests
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

        $tests=TestModel::find($id);
        if ($tests){

            return response()->json([
                'status'=>200,
                'tests'=>$tests
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
            // 'cid'=>'0',
            'id'=>'required',
            'tel'=>'required',
     
    
          ]);
    
          if($validator->fails()){
    
    
            return response()->json([
                'status' =>422,
                'error'=>$validator->messages()
            ],422);
    
            
    
          }
    
          else {

            $tests=TestModel::find($id);
            if($tests){
        
    
                $tests->update([
                    // 'cid'=>$request->cid,
                    'id'=>$request->id,
                    'tel'=>$request->tel,
            
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




