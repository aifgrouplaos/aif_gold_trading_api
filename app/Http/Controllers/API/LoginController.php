<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use  Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{

    public function __construct()
    {

        // $this->middleware(['prevent-back-history']);

        //parent::__construct();
        if(Auth::user()){
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.home');
           }else{
                  return redirect()->route('home');
           }

          Auth::user()->remember_token;
        }else{
            return view('login');
        }
    }



    public function index(){


        if(Auth::user()){
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.home');
           }else{
                  return redirect()->route('home');
           }


          // Auth::user()->remember_token;
        }else{
      
          return view('login');
        }
        //
    }

    public function logout(Request $request)
    {

        $id= Auth::user()->id;
        $updateToken=DB::table('users')
            ->where('id', '=', $id)
            ->update([
                'status'=> '0'
                ]);
        Auth::logout();
        Session::flush();
        return redirect('login_user');
    }
    public function login(Request $request)
    {



      //  return $request->username;


        if(auth()->attempt(array('username' => $request['username'], 'password' => $request['password'])))
        {

            $random = Str::random(40);
            $token=Hash::make($random);
            $updateToken=DB::table('users')
            ->where('username', '=', $request['username'])
            ->update([
                'remember_token'=> $token, 'status'=> '1'
                ]);

            $userdata=DB::table('users')
                ->select('remember_token', 'fname', 'lname', 'contact')
                 ->where('username', '=',$request['username'])
                 ->get();
                 $tokedb='';$fname='';$lname='';$contact='';
                 Session::put('userdata',$userdata);

                 return response()->json([
                    'status'=>200,
                    'token'=>$token,
                    'msg'=>"login successfully"
                ],200);
        }

        else {
            return response()->json([
                'status'=>500,
                'msg'=>"user or password wrong!"
            ],500);

        }

    }




}
