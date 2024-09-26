<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerList;
use App\Models\Reservation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\str;
use Illuminate\Support\Carbon;
use Mail;
use App\Models\PasswordReset;

use Yajra\DataTables\DataTables;

class Yb_CustomerListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = CustomerList::latest()->orderBy('customer_id','desc')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
        $btn = '<a href= "javascript:void(0)" data-id="'.$row->customer_id.'" class="editCustomer btn btn-success btn-sm" >Edit</a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    } 
        return view('admin.customer_list.index'); 
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('customer_id')){
            return redirect('user/profile');
        }else{
            return view('public.signup');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:customer_list,email',
            'phone'=>'required',
        ]);

        $customerlist = new CustomerList();
        $customerlist->customer_name = $request->input("name");
        $customerlist->email = $request->input("email");
        $customerlist->phone = $request->input("phone");
        $customerlist->password = Hash::make($request->input("password"));
        $customerlist->address = $request->input("address");
        if(session()->get('admin') != ''){ 
            $customerlist->created_by = 'admin';
        }else {
            $customerlist->created_by = 'customer';
        }
        $result = $customerlist->save();
        if($result == '1' && session()->get('admin') == ''){
            $customer = CustomerList::where('email',$request->email)->first();
            $request->session()->put('customer_id',$customer->customer_id);
            $request->session()->put('customer_name',$customer->customer_name);
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(session()->has('customer_id')){
            $id = session()->get('customer_id');
            $customerList = CustomerList::where(['customer_id'=> $id])->first();
            $reservations = Reservation::select(['reservation.*','table_list.table_name'])->where('reservation.customer_id',$id)
                            ->leftJoin('table_list','table_list.table_id','=','reservation.table_id')
                            ->latest()
                            ->get();
                            if(!$customerList){
                                return abort('404');
                            }
            return view('public.profile',['customer'=> $customerList,'reservations'=>$reservations]);
        }else{
            return redirect('login');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $customerlist = CustomerList::where(['customer_id'=>$id])->get();
        return $customerlist;
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
        //
        $request->validate([
            'customer_name'=>'required',
            'email'=>'required|email|unique:customer_list,email,' .$id. ',customer_id',
            'phone'=>'required',
        ]);

        // update Customer password
        if($request->password != ''){ 
            $password = Hash::make($request->password);
        }else{
            $password = $request->old_password;
        }

        $customerlist = CustomerList::where(['customer_id'=>$id])->update([
            "customer_name"=>$request->input('customer_name'),
            "email"=>$request->input('email'),
            "password" => $password,
            "phone"=>$request->input('phone'),
            "address"=>$request->input('address'),
        ]);
        return $customerlist;
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

    function yb_customerUpdate(Request $request){
        $id = $request->session()->get('customer_id');
        if($request->input()){
            $request->validate([
                'name'=>'required',
                'phone'=>'required',
                'address'=>'required',
            ]);

            $update = DB::table('customer_list')->where(["customer_id" => $id])->update([
                "customer_name"=>$request->name,
                "phone"=>$request->phone,
                "address"=>$request->address,
            ]);
            return $update;
        }else{
            return view('/user/profile');
        }
    }



    public function yb_login(Request $req){
        //return $req->session()->get('user');
        if(session()->has('customer_id')){
            return redirect('user/profile');
        }else{
            if($req->input()){

                $req->validate([
                    'user_name' => 'required|email',
                    'user_password' => 'required',
                ]);

                $user = $req->input('user_name');
                $pass = $req->input('user_password');

                $login = CustomerList::select(['customer_id','customer_name','email','password'])
                                ->where('email',$user)
                                ->first();
                if($login){
                    //return $login['customer_id'];
                    if(Hash::check($pass,$login['password'])){
                            $req->session()->put('customer_id',$login['customer_id']);
                            $req->session()->put('customer_name',$login['customer_name']);
                            return '1'; 
                    }else{
                        return 'Email Address and Password Not Matched.'; 
                    }
                }else{
                    return 'Email Does Not Exists'; 
                }
            }else{
                return view('public.login');
            }
        }
        
    }

    public function yb_logout(Request $request){
        $request->session()->forget('customer_id');
        $request->session()->forget('customer_name');
        return '1';
    }

    public function yb_changePassword(Request $request){
        if($request->input()){
            $id = session()->get('customer_id');
            $customer = CustomerList::where('customer_id',$id)->update([
                'password' => Hash::make($request->input("new"))
            ]);
            return '1';
        }
        return view('public.change-password');
    }

    public function yb_forgotPassword(Request $request){
        if(!session()->has('customer_id')){
            if($request->input()){
                try{
                    $customer = CustomerList::where('email',$request->email)->first(); 
                    if($customer){
                        if($customer->status == '0'){
                            return 'Your account is blocked by Site Administrator';
                        }
                        $token = Str::random(40);
                        $domain = URL::to('/');
                        $url = $domain.'/reset-password?token='.$token;

                        $data['url'] = $url;
                        $data['user_email'] = $request->email;
                        $data['user_name'] = $customer->customer_name;
                        $data['title'] = 'Password Reset';
                        $data['body'] = 'Please click on below link to reset you password.';

                        Mail::send('public.forgotPasswordMail',['data'=>$data],function($message) use ($data){
                                $message->to($data['user_email'])->subject($data['title']);
                        });
                        $dataTime = Carbon::now()->format('Y-m-d H:i:s');
                        PasswordReset::updateOrCreate(
                            ['email' => $request->email],
                            [
                            'email' => $request->email,
                            'token'=> $token,
                            'created_at' => $dataTime
                            ]
                        );
                        return 'Please check your mail to reset your password'; 
                    }else{
                        return 'Email Does Not Exists!'; 
                    }
                    }catch(\Exception $e){
                        return response()->json(['error',$e->getMessage()]);
                    }
            }else{
                return view('public.forgot-password');
            }
        }else{
            return abort('404');
        }
    }

    public function yb_reset_password(Request $request){
        
            $resetData = PasswordReset::where('token',$request->token)->get();
              if(isset($request->token) && count($resetData) > 0){
                  $customer = CustomerList::where('email',$resetData[0]['email'])->first();
                  return view('public.reset-password',compact('customer'));
              }else{
                  return abort('404');
              }
        
       
    }

    public function yb_reset_passwordUpdate(Request $request){
        $request->validate([
            'password'=> 'required',
            'confirm_password'=> 'required',
        ]);

        $data = CustomerList::where(['customer_id'=>$request->id])->update([
            "password" => Hash::make($request->input("password")),
        ]);
        $customer = CustomerList::where('customer_id',$request->id)->first();
        PasswordReset::where('email',$customer->email)->delete();
        return '1';
    }

    
}
