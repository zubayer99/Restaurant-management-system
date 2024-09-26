<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use App\Models\City;

use Yajra\DataTables\DataTables;

class Yb_StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $country = Country::all();
        if ($request->ajax()) {
            //$data = State::orderBy('id','desc')->get();
            $data = State::select(['states.*','countries.country_name as country'])
                ->LeftJoin('countries','states.country_id','=','countries.country_id')
                ->orderBy('states.state_id','desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->state_id.'" class="editState btn btn-success btn-sm" >Edit</a>   <button type="button" value="delete" class="btn btn-danger btn-sm delete-state" data-id="'.$row->state_id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        } 
         return view('admin.state.index',['country'=> $country]); 

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
            'state'=> 'required|unique:states,state_name',
            'country' => 'required'
        ]);

        $state = new State();
        $state->state_name = $request->input("state");
        $state->country_id = $request->input("country");
        $result =  $state->save();
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
        $state = State::where('state_id',$id)->get();
        return $state;
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
            'state'=> 'required|unique:states,state_name,'.$id. ',state_id',
            'country' => 'required'
        ]);

        $state = State::where(['state_id'=>$id])->update([
            "state_name"=>$request->input('state'),
            "country_id"=>$request->input('country'),
        ]);
        return $state;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exp = City::where('state_id','=',$id)->first();
        if($exp === null){
            $destroy = State::where('state_id',$id)->delete();
        return  $destroy;
        }else{
            return response()->json("You won't delete this. This State is used in Cities List");
        }
       
    }
}
