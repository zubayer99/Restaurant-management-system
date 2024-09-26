<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuType;
use App\Models\manageFood;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\View;
use File;

class Yb_MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        //
        if ($request->ajax()) {
            $data = MenuType::latest()->orderBy('id','desc')->get();
            return Datatables::of($data)
            ->addColumn('image',function($row){
                if($row->image != ''){
                    $img = '<img src="'.asset("public/menu_type/".$row->image).'" width="70px">';
                }else{
                    $img = '<img src="'.asset("public/menu_type/default.png").'" width="70px">';
                }
                return $img;
            })
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
            $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editMenu btn btn-success btn-sm" >Edit</a>   <button type="button" value="delete" class="btn btn-danger btn-sm delete-menu" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action','image'])
            ->make(true);
        } 
        return view('admin.menu_type.index'); 
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
            'menu_name'=>'required|unique:menu_type,menu_type',
            'status'=>'required',
        ]);

        if($request->img){
            $image = $request->img->getClientOriginalName();
            $request->img->move(public_path('menu_type'),$image);
        }else{
           $image = ""; 
        }

        $MenuType = new MenuType();
        $MenuType->menu_type = $request->input("menu_name");
        $MenuType->image = $image;
        $MenuType->status = $request->input("status");
        $result =  $MenuType->save();
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
        $MenuType = MenuType::where('id',$id)->first();
        return VIEW::make('admin.menu_type.edit',['menuType'=>$MenuType]);
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
        $request->validate([
            'menu_name'=>'required|unique:menu_type,menu_type,' .$id. ',id',
            'status'=>'required',
        ]);
        
         // update MenuType image
        if($request->img != ''){        
            $path = public_path().'/menu_type/';
            //code for remove old file
            if($request->old_img != ''  && $request->old_img != null){
                $file_old = $path.$request->old_img;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->img;
            $image = $request->img->getClientOriginalName();
            $file->move($path, $image);
        }else{
            $image = $request->old_img;
        }

        $MenuType = MenuType::where(['id'=>$id])->update([
            "menu_type"=>$request->input('menu_name'),
            "image"=> $image,
            "status"=>$request->input('status'),
        ]);
        return $MenuType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exp = ManageFood::where('menu_type','=',$id)->first();
        if($exp === null){
            $destroy = MenuType::where('id',$id)->delete();
            return  $destroy;
        }else{
            return response()->json("You won't delete this. This Name is used in Food Items List");
        }
        
    }
}
