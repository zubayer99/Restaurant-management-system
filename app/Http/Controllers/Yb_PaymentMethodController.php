<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

use Yajra\DataTables\DataTables;

class Yb_PaymentMethodController extends Controller
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
            $data = PaymentMethod::orderBy('payment_id','desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function($row){
                if($row->status == '1'){
                    $status =  '<span class="badge btn-success">Active</span>';
                }else{
                    $status =  '<span class="badge btn-danger">Inactive</span>';
                }
                return $status;
            })
            ->addColumn('action', function($row){
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->payment_id.'" class="editPayment btn btn-success btn-sm" >Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-payment" data-id="'.$row->payment_id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.payment_method.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'payment_name'=> 'required|unique:payment_method,payment_name',
            'status' => 'required'
        ]);

        $paymentMethod = new PaymentMethod();
        $paymentMethod ->payment_name = $request->input("payment_name");
        $paymentMethod ->status = $request->input("status");
        $result =  $paymentMethod ->save();
        return $result;
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
        $paymentMethod = PaymentMethod::where('payment_id',$id)->get();
        return $paymentMethod;
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
            'payment_name'=> 'required|unique:payment_method,payment_name,'.$id. ',payment_id',
            'status' => 'required',
        ]);

        $paymentMethod = PaymentMethod::where(['payment_id'=>$id])->update([
            "payment_name"=>$request->input('payment_name'),
            "status"=>$request->input('status'),
        ]);
        return $paymentMethod;
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
        $destroy = PaymentMethod::where('payment_id',$id)->delete();
        return  $destroy;
    }
}
