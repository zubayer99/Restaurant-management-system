<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageFood;
use App\Models\Category;
use App\Models\MenuType;

use Yajra\DataTables\DataTables;

class Yb_ManageFoodController extends Controller
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
            $data = ManageFood::select(['manage_food.*','categories.category_name as category'])
            ->leftJoin('categories','manage_food.category','=','categories.cat_id')
            ->orderBy('manage_food.food_id','desc')->get(); 
            return Datatables::of($data)
            ->addColumn('image',function($row){
                if($row->image != ''){
                    $img = '<img src="'.asset("public//manage_food/".$row->image).'" width="70px">';
                }else{
                    $img = '<img src="'.asset("public//manage_food/default.png").'" width="70px">';
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
            $btn = '<a href= "manage_food/'.$row->food_id.'/edit" class="btn btn-success btn-sm">Edit</a> <button type="button" value="delete" class="btn btn-danger btn-sm delete-food" data-id="'.$row->food_id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action','image'])
            ->make(true); 
        } 
        return view('admin.manage_food.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        $menuType = MenuType::all();
        return view('admin.manage_food.create',['category'=>$category,'menuType'=> $menuType]);
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
            'food_name'=>'required|unique:manage_food,food_name',
            'category'=>'required',
            'menu_type'=>'required',
            'description'=>'required',
            'time'=>'required',
            'price'=>'required',
            'status'=>'required',
        ]);

        if($request->img){
            $image = $request->img->getClientOriginalName();
            $request->img->move(public_path('manage_food'),$image);
        }else{
           $image = ""; 
        }

        $manageFood = new ManageFood();
        $manageFood->food_name = $request->input("food_name");
        $manageFood->category = $request->input("category");
        $manageFood->menu_type = $request->input("menu_type");
        $manageFood->description = $request->input("description");
        $manageFood->image = $image;
        $manageFood->cooking_time = $request->input("time");
        $manageFood->price = $request->input("price");
        $manageFood->status = $request->input("status");
        $result =  $manageFood->save();
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
        $category = Category::all();
        $menuType = MenuType::all();
        $manageFood = ManageFood::where(['food_id'=>$id])->first();
        return view('admin.manage_food.edit',['food'=> $manageFood,'category'=>$category,'menuType'=> $menuType]);
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
            'food_name'=>'required|unique:manage_food,food_name,' .$id. ',food_id',
            'category'=>'required',
            'menu_type'=>'required',
            'description'=>'required',
            'time'=>'required',
            'price'=>'required',
            'status'=>'required',
        ]);

        // update ManageFood image
        if($request->img != ''){        
            $path = public_path().'/manage_food/';
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

        $manageFood = ManageFood::where(['food_id'=>$id])->update([
            "food_name"=>$request->input('food_name'),
            "category"=>$request->input('category'),
            "menu_type"=>$request->input('menu_type'),
            "description"=>$request->input('description'),
            "image"=> $image,
            "cooking_time"=>$request->input('time'),
            "price"=>$request->input('price'),
            "status"=>$request->input('status'),
        ]);
        return $manageFood;
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
        $destroy = ManageFood::where('food_id',$id)->delete();
        return  $destroy;
    }
}
