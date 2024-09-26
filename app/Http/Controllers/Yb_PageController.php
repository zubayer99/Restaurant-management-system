<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use Illuminate\Support\Str;

use Yajra\DataTables\DataTables;

class Yb_PageController extends Controller
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
            $data = Pages::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
            $btn = '<a href="pages/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-page" data-id="'.$row->id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        } 
        return view('admin.pages.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
        $request->validate(['title'=>'required|unique:pages,title',]);

        $page = new Pages();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->content = htmlspecialchars($request->content);
        $page->show_in_header = $request->show_header;
        $page->show_in_footer = $request->show_footer;
        $page->status = $request->status;
        $result = $page->save();
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
        $page = Pages::where(['id'=>$id])->first();
        return view('admin.pages.edit',['page'=>$page]);
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
        $request->validate(['title'=>'required|unique:pages,title,' .$id. ',id']);

        $page =  Pages::where(['id'=>$id])->update([
            "title"=>$request->title,
            "slug"=>$request->slug,
            "content"=>htmlspecialchars($request->content),
            "show_in_header"=>$request->show_header,
            "show_in_footer"=>$request->show_footer,
            "status"=>$request->status,
        ]);

        return $page;
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
        $destroy = Pages::where('id',$id)->delete();
        return  $destroy;
    }
}
