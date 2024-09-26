<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waiter;

use Yajra\DataTables\DataTables;

class Yb_WaiterController extends Controller
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
            $data = Waiter::latest()->get();
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
            $btn = '<a href="waiters/'.$row->id.'/edit" class="btn btn-success btn-sm" >Edit</a> <button type="button" value="delete" class="btn btn-danger btn-sm delete-waiter" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.waiters.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.waiters.create');
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
            'name'=>'required|unique:waiters,name',
            'email'=>'email',
            'phone'=>'required',
            'address'=>'required',
        ]);

        $waiter = new Waiter();
        $waiter->name = $request->name;
        if($request->email && $request->email != ''){
            $waiter->email = $request->email;
        }
        $waiter->phone = $request->phone;
        $waiter->address = $request->address;
        $result = $waiter->save();
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
        $waiter = Waiter::where(['id'=>$id])->first();
        return view('admin.waiters.edit',['waiters'=> $waiter]);
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
       // return $request->input();
        $request->validate([
            'name'=>'required|unique:waiters,name,'.$id. ',id',
            'email'=>'email',
            'phone'=>'required',
            'address'=>'required',
        ]);
        
        $waiter = Waiter::where(['id'=>$id])->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "status" => $request->status,
        ]);
        return $waiter;
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
        $destroy = Waiter::where('id',$id)->delete();
        return  $destroy;
    }


    
}
