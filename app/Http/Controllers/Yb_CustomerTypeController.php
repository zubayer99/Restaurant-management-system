<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer_type;
use Illuminate\Support\Str;

use Yajra\DataTables\DataTables;

class Yb_CustomerTypeController extends Controller
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
            $data = Customer_type::orderBy('id','desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editCustomerType btn btn-success btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-customerType" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        } 
        return view('admin.customer_type.index'); 
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
        $request->validate(['title'=>'required|unique:customer_types,title']);

        $c_type = new Customer_type();
        $c_type->title = $request->title;
        $c_type->slug = Str::slug($request->title);
        $result = $c_type->save();
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
        $c_type = Customer_type::where(['id'=>$id])->get();
        return $c_type;
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
        $request->validate(['title'=>'required|unique:customer_types,title,' .$id. ',id']);

        $c_type =  Customer_type::where(['id'=>$id])->update([
            "title"=>$request->title,
        ]);

        return $c_type;
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
        $destroy = Customer_type::where('id',$id)->delete();
        return  $destroy;
    }
}
