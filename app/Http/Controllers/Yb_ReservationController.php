<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\TableList;
use App\Models\CustomerList;


use Yajra\DataTables\DataTables;

class Yb_ReservationController extends Controller
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
            $data = Reservation::select(['reservation.*','table_list.table_name','customer_list.customer_name'])
                ->LeftJoin('table_list','reservation.table_id','=','table_list.table_id')
                ->LeftJoin('customer_list','reservation.customer_id','=','customer_list.customer_id')
                ->orderBy('reservation.reservation_id','desc')->get(); 
            return Datatables::of($data) 
            ->addIndexColumn()
            ->editColumn('date', function($row){
                // if(date('d',strtotime($row->date)) == date('d')){
                //     $date =date('H:i a',strtotime($row->date));
                // }else{
                //     $date =date('d M, Y',strtotime($row->date));
                // }
                $date = date('d M, Y',strtotime($row->date));
                return  $date;
            })
            ->editColumn('status', function($row){
                if($row->status == '1'){
                    $status =  '<span class="badge btn-success">Booked</span>';
                }else{
                    $status =  '<span class="badge btn-primary">Free</span>';
                }
                return $status;
            })
            ->addColumn('action', function($row){
            $btn = '<a href="reservation/'.$row->reservation_id.'/edit" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a> <button type="button" value="delete" class="btn btn-danger btn-sm delete-reservation" data-id="'.$row->reservation_id.'"><i class="fa fa-trash"></i></button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.reservation.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.reservation.create');
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
    //    return $request->input();
              
        if(session()->get('customer_id') == ''){
            $request->validate([
                'customer_name'=>'required',
                'phone'=>'required',
            ]);

            $customerlist = new CustomerList();
            $customerlist->customer_name = $request->input("customer_name");
            if($request->email && $request->email != ''){
                $customerlist->email = $request->input("email");
            }
            $customerlist->phone = $request->input("phone");
            if(session()->get('admin') != ''){ 
                $customerlist->created_by = 'admin';
            }else{
                $customerlist->created_by = 'customer';
            }
            $customerlist->save();
           // return $customerlist; 
            $customer_id= $customerlist->id;
        }else{
            $customer_id= session()->get('customer_id');
        }
         //return $customer_id;
        $reservation = new Reservation();
        $reservation->customer_id = $customer_id;
        $reservation->table_id = $request->input("table_no");
        $reservation->date = $request->input("date");
        $reservation->number_of_person = $request->input("no_person");
        $reservation->start_time = $request->input("start_time");
        $reservation->end_time = $request->input("end_time");
        $reservation->status = '1';
        $reservation->save();
              
        $tablelist = TableList::where(['table_id'=>$request->input("table_no")])->update([
            "status"=> '1',
        ]);
        return '1';
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
        //

        $reservation = Reservation::select(['reservation.*','customer_list.customer_name','customer_list.email','customer_list.phone'])
                    ->LeftJoin('customer_list','reservation.customer_id','=','customer_list.customer_id')
                    ->where(['reservation_id'=>$id])->first();
                return view('admin.reservation.edit',['reservation'=> $reservation]);
      
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
        //return $request->input();
        $customer =  $request->input('customer_id');
        $request->validate([
            'end_time'=>'required',
            'customer_id'=>'required',
            'phone'=>'required',
            'status'=>'required',
        ]);
        $email = '';
        if($request->email && $request->email != ''){
            $email = $request->email;
        }
  
        $customerlist = CustomerList::where(['customer_id'=> $customer])->update([
            "customer_name"=>$request->input('customer_name'),
            "email"=>$email,
            "phone"=>$request->phone,
        ]); 
 
        $reservation = Reservation::where(['reservation_id'=>$id])->update([
            "customer_id"=>$request->input('customer_id'),
            "end_time"=>$request->input('end_time'),
            "status"=>$request->input('status'),
        ]);
        return $reservation; 
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
        $destroy = Reservation::where('reservation_id',$id)->delete();
        return  $destroy;
    }

    public function yb_checkavailablity(Request $request){
        // return $request->input();
        $request->validate([ 
            'date'=>'required',
            'time'=>'required',
            'person'=>'required',
        ]); 

        $date = $request->input('date');
        $time = $request->input('time');
        $person = $request->input('person');

        $reservation = Reservation::select("table_id")
            ->where('status', '=', 1)
                ->where('date', '=', $date)
                ->where('start_time', '<=', $time)
                ->where('end_time', '>=', $time)
                ->where('number_of_person', '=', $person)
                ->get();
        $tablelist = TableList::select("*")
                ->whereNotIn('table_id',$reservation)
                ->where('capacity', '>=', $person)
                ->get();
        $output = '';
        if($tablelist->isNotEmpty()){
        $output .= '<ul class="table-list row">';
        foreach($tablelist as $table){
            $output .= '<li class="col-md-2"><button type="button" data-id="'.$table->table_id.'" class="table_id">'.$table->table_name.'</button></li>';
            
        }
        $output .= '</ul>';
        }
        return $output;
    }
}
