<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;


use Yajra\DataTables\DataTables;

class Yb_CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $state = State::all();
        if ($request->ajax()) {
            $data = City::select(['cities.*','states.state_name as state'])
                ->LeftJoin('states','cities.state_id','=','states.state_id')
                ->orderBy('cities.city_id','desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->city_id.'" class="editcity btn btn-success btn-sm" >Edit</a>   <button type="button" value="delete" class="btn btn-danger btn-sm delete-city" data-id="'.$row->city_id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        } 
        return view('admin.city.index',['state'=> $state]); 
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
            'state' => 'required',
            'city_name'=> 'required|unique:cities,city_name'           
        ]);

        $city = new City();
        $city->state_id = $request->input("state");
        $city->city_name = $request->input("city_name");
        $result =  $city->save();
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
        $city = City::where('city_id',$id)->get();
        return $city;
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
            'state'=> 'required',
            'city_name' => 'required|unique:cities,city_name,'.$id. ',city_id'
          
           
        ]);

        $city = City::where(['city_id'=>$id])->update([
            "state_id"=>$request->input('state'),
            "city_name"=>$request->input('city_name'),
        ]);
        return $city;
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
        $destroy = City::where('city_id',$id)->delete();
        return  $destroy;
    }
}
