<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\KitchenSetting;
use App\Models\OrderMenu;

use Yajra\DataTables\DataTables;

class Yb_KitchenSettingController extends Controller
{
    public function yb_kitchenLogin(Request $request){
        //return $request->input();
        if($request->input()){
            $request->validate([
                'username'=>'required',
                'password'=>'required',
            ]); 
            $username = $request->input('username');
            $password = $request->input('password');
            $kitchen = KitchenSetting::select("username","password","status")->where(['username'=> $username])->first();
           

            if(!empty( $kitchen)){
                if($kitchen->status == '1'){
                    if(Hash::check($password,$kitchen->password)){
                        $request->session()->put('kitchen','kitchen');
                        return response()->json(['success'=>'Logged In Succesfully']);
                    }else{
                        return response()->json(['password'=>'Username and Password does not matched']);
                    }
                }else{
                    return response()->json(['error'=>'This Login is blocked by Admin']);
                }
            }else{
                return response()->json(['error'=>'Username does not exists.']);
            }
        }else{
            return view('kitchen.kitchen');
        }    
    }

    function yb_homePage(){
        $orders = OrderMenu::with('order_items')->whereIn('status',['0','1'])->get();
        return view('kitchen.dashboard',compact('orders'));
    }


    public function yb_logout(Request $req) {
        Auth::logout();
        session()->forget('kitchen');
        return redirect('/kitchen');
    }
}
