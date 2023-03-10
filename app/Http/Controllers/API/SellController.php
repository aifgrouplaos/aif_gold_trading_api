<?php

namespace App\Http\Controllers;

use App\Models\SellerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\ElseIf_;

class SellerController extends Controller
{
    protected $redirectTo = ('home');


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','prevent-back-history']);

        if(Auth::user()){
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.home');
           }else{
                  return redirect()->route('home');
           }
        }else{
            return view('login');
        }


    }

    public function index()
    {
              return view('admin.seller.index');

    }

    public function AddSeller(Request $request)
    {

       // echo $request->cname;
        $seller = new SellerModel();
        $Sellercheck =  $seller->select('sid')->where('sname','=' ,$request->cname)->first();
        if(isset($Sellercheck)){
            return  response()->json("Already Exist");
        }else{

            $seller->insert([
                'sname'=> $request->cname,
                'saddress'=> $request->address,
                'scontact'=> $request->contact,
                'createDate'=>now(),
                'updated_at'=>now(),
                'userid'=>Auth::user()->id
            ]);

            return  response()->json("Create Successfully!");
        }


    }

 
    public function sellerlist()
    {

              $seller=  SellerModel::orderBy('sid', 'desc')
              ->join('users','id', '=', 'tblseller.userid')
                ->select('sid','sname','saddress','scontact','createDate','tblseller.updated_at'
                ,DB::raw('CONCAT(Fname, " ", Lname) AS userFullname'))
                ->get();
               return view('admin.seller.list',["SellerList"=>$seller ]);

    }


    public function DeleteSeller($id)
    {
        //return $id;
        SellerModel::where('sid' ,'=',$id)->delete();
    }

    public function UpdateSeller(Request $request)
    {
       $customer = SellerModel::where('sid', '=', $request->id)->first();
       $customer->update([
            'sname'=> $request->cname,
            'saddress'=> $request->address,
            'scontact'=>$request->contact,
            'updated_at'=> now(),
            'userid'=>Auth::user()->id

        ]);
        return  response()->json("Update Successfully!");

    }


}
