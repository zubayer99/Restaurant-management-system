<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;

use Yajra\DataTables\DataTables;

class Yb_CountryController extends Controller
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
            $data = Country::orderBy('country_id','desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->country_id.'" class="editCountry btn btn-success btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-country" data-id="'.$row->country_id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        } 
        return view('admin.country.index'); 
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
        $request->validate(['country_name'=>'required|unique:countries,country_name',]);

        $country = new Country();
        $country->country_name = $request->input("country_name");
        $result = $country->save();
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
        $country = Country::where(['country_id'=>$id])->get();
        return $country;
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
        $request->validate(['country_name'=>'required|unique:countries,country_name,' .$id. ',country_id']);

        $country =  Country::where(['country_id'=>$id])->update([
            "country_name"=>$request->input('country_name'),
        ]);

        return $country;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exp = State::where('country_id','=',$id)->first();
        if($exp === null){
            $destroy = Country::where('country_id',$id)->delete();
            return  $destroy;
        }else{
            return response()->json("You won't delete this. This Country is used in States List");
        }
        
    }
}
