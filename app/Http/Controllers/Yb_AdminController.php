<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\OrderMenu;
use App\Models\Reservation;
use App\Models\CustomerList;

use Illuminate\Http\Request;

class Yb_AdminController extends Controller
{
    //
    public function index(Request $request){
        
		if($request->input()){

			$request->validate([
				'username'=>'required',
				'password'=>'required',
			]); 
			// return Hash::make($request->input('password'));
		
			$login = Admin::where(['username'=>$request->username])->pluck('password')->first();
			
			if(empty($login)){
				return response()->json(['error'=>'Username Does not Exists']);
			}else{
				if(!Hash::check($request->password,$login)){
					return response()->json(['error'=>'Username and Password does not matched']);
				}else{
					$admin = Admin::first();
					$request->session()->put('admin','1');
					$request->session()->put('admin_name',$admin->admin_name);
					$request->session()->put('email',$admin->email); 
					return response()->json(['success'=>'Logged In Succesfully']);
				}
			}
		}else{
			return view('admin.admin');
		}
    }

    public function dashboard(){
		$date = date('Y-m-d');
        $data['today_orders'] = OrderMenu::where('status','2')->whereDate('created_at',$date)->count('id');
        $data['today_sales'] = OrderMenu::where('status','2')->whereDate('created_at',$date)->sum('net_amount');
        $data['reservations'] = Reservation::count('reservation_id');
        $data['customers'] = CustomerList::count('customer_id');
        $data['latest_orders'] = OrderMenu::select(['order_list.*','customer_list.customer_name','table_list.table_name'])
					->leftJoin('customer_list','order_list.customer','=','customer_list.customer_id')
					->leftJoin('table_list','order_list.table','=','table_list.table_id')
					->groupBy('order_list.id')
					->orderBy('order_list.id','desc')
					->limit(5)
					->latest()
					->get();
        $data['latest_reservations'] = Reservation::select(['reservation.*','table_list.table_name','customer_list.customer_name'])
					->LeftJoin('table_list','reservation.table_id','=','table_list.table_id')
					->LeftJoin('customer_list','reservation.customer_id','=','customer_list.customer_id')
					->orderBy('reservation.reservation_id','desc')
					->limit(5)
					->latest()
					->get();

        return view('admin.dashboard',$data);
        
	}
	
	public function yb_logout(Request $req) {
		Auth::logout();
		session()->forget('admin');
		session()->forget('admin_name');
		session()->forget('email');
		return response()->json(['success'=>'1']);
	}

	public function yb_changePassword(Request $request){
		if($request->input()){
			$request->validate([
                'password'=> 'required',
                'new'=> 'required',
                'new_confirm'=> 'required',
            ]);

            $get_admin = DB::table('admin')->first();

            if(Hash::check($request->password,$get_admin->password)){
                DB::table('admin')->update([
                    'password'=>Hash::make($request->new)
                ]);
				return '1';
			}else{
				return 'Please Enter Correct Current Password';
			}
		}else{
			return view('admin.change-password');
		}
	}

}
