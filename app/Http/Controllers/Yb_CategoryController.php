<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\ManageFood;

use Yajra\DataTables\DataTables;

class Yb_CategoryController extends Controller
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
            $data = Category::latest()->orderBy('cat_id','desc')->get();
            return Datatables::of($data)
            ->addColumn('image',function($row){
                if($row->image != ''){
                    $img = '<img src="'.asset("public/manage_category/".$row->image).'" width="70px">';
                }else{
                    $img = '<img src="'.asset("public/manage_category/default.png").'" width="70px">';
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
            $btn = '<a href="manage_category/'.$row->cat_id.'/edit" class="btn btn-success btn-sm">Edit</a> <button type="button" value="delete" class="btn btn-danger btn-sm delete-category" data-id="'.$row->cat_id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action','image'])
            ->make(true);
        } 
        return view('admin.manage_category.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.manage_category.create');
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
            'category_name'=>'required|unique:categories,category_name',
            'status'=>'required',
        ]);

        if($request->img){
            $image = $request->img->getClientOriginalName();
            $request->img->move(public_path('manage_category'),$image);
        }else{
           $image = ""; 
        }

        $category = new Category();
        $category->category_name = $request->input("category_name");
        $category->image = $image;
        $category->status = $request->input("status");
        $result =  $category->save();
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
        $category = Category::where(['cat_id'=>$id])->first();
        return view('admin.manage_category.edit',['category'=> $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            'category_name'=>'required|unique:categories,category_name,' .$id. ',cat_id',
            'status'=>'required',
        ]);

        //update Manage Category image
        if($request->img != ''){        
            $path = public_path().'/manage_category/';
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
       
        $category = Category::where(['cat_id'=>$id])->update([
            "category_name"=>$request->input('category_name'),
            "image"=> $image,
            "status"=>$request->input('status'),
        ]);
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exp = ManageFood::where('category','=',$id)->first();
        if($exp === null){
            $destroy = Category::where('cat_id',$id)->delete();
        return  $destroy;
        }else{
            return response()->json("You won't delete this. This Category is used in Food Items");
        }
        
    }
}
