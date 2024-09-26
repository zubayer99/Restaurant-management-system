<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Yajra\DataTables\DataTables;

class Yb_BannerController extends Controller
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
            $data = Banner::latest()->orderBy('id','desc')->get();
            return Datatables::of($data)
            ->addColumn('image',function($row){
                if($row->image != ''){
                    $img = '<img src="'.asset("public/banners/".$row->image).'" width="70px">';
                }else{
                    $img = '<img src="'.asset("public/banners/default.png").'" width="70px">';
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
            $btn = '<a href="banners/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <button type="button" value="delete" class="btn btn-danger btn-sm delete-banner" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['status','action','image'])
            ->make(true);
        } 
        return view('admin.banners.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->input();
        $request->validate([
            'title'=>'required|unique:banners,title',
        ]);

        if($request->img){
            $image = time().'.'.$request->img->getClientOriginalExtension();
            $request->img->move(public_path('banners'),$image);
        }else{
           $image = ""; 
        }

        $banner = new Banner();
        $banner->title = $request->input("title");
        $banner->image = $image;
        $banner->descr = $request->input("descr");
        $banner->btn_text = $request->input("btn_text");
        $banner->btn_link = $request->input("btn_link");
        $result =  $banner->save();
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
        $banner = Banner::find($id);
        return view('admin.banners.edit',compact('banner'));
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
            'title'=>'required|unique:banners,title,' .$id. ',id',
            'status'=>'required',
        ]);

        //update Banner image
        if($request->img != ''){        
            $path = public_path().'/banners/';
            //code for remove old file
            if($request->old_img != ''  && $request->old_img != null){
                $file_old = $path.$request->old_img;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->img;
            $image = time().'.'.$request->img->getClientOriginalExtension();
            $file->move($path, $image);
        }else{
            $image = $request->old_img;
        }
       
       $banner = Banner::findOrFail($id);
       $banner->title = $request->title;
       $banner->image = $image;
       $banner->descr = $request->descr;
       $banner->btn_text = $request->btn_text;
       $banner->btn_link = $request->btn_link;
       $banner->status = $request->status;
       $result = $banner->save();
        return $result;
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
        $destroy = Banner::destroy($id);
        return  $destroy;
    }
}
