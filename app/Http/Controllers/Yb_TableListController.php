<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableList;

use Yajra\DataTables\DataTables;

class Yb_TableListController extends Controller
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
            $data = TableList::latest()->orderBy('table_id','desc')->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('status', function($row){
            if($row->status == '1'){
                $status = '<span class="badge btn-success">Booked</span>';
            }else{
                $status =  '<span class="badge btn-primary">Free</span>';
            }
            return $status;
        })
        ->addColumn('action', function($row){
        $btn = '<a href= "javascript:void(0)" data-id="'.$row->table_id.'" class="edittable btn btn-success btn-sm" >Edit</a>   <button type="button" value="delete" class="btn btn-danger btn-sm delete-table" data-id="'.$row->table_id.'">Delete</button>';
            return $btn;
        })
        ->rawColumns(['status','action'])
        ->make(true);
    } 
        return view('admin.table_list.index'); 
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
            'table_name'=>'required|unique:table_list,table_name',
            'capacity'=>'required',
        ]);

        $tableList = new TableList();
        $tableList->table_name = $request->input("table_name");
        $tableList->capacity = $request->input("capacity");
        $result = $tableList->save();
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
        $tableList = TableList::where(['table_id'=>$id])->get();
        return $tableList;
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
            'table_name'=>'required|unique:table_list,table_name,'.$id. ',table_id',
            'capacity'=>'required',
        ]);
  
        $tableList = TableList::where(['table_id'=>$id])->update([
            "table_name"=>$request->input('table_name'),
            "capacity"=>$request->input('capacity'),
        ]);
        return $tableList;
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
        $destroy = TableList::where('table_id',$id)->delete();
        return  $destroy;
    }
}
