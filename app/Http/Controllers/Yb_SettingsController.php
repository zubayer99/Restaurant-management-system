<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\ContactUsForm;
use App\Models\KitchenSetting;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class Yb_SettingsController extends Controller
{

    public function yb_general_settings(Request $request){
        if($request->input()){

            $request->validate([
                'app_title'=>'required',
                'store_name'=>'required',
                'address'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'logo'=>'image|mimes:jpeg,png,jpg|max:2048',
                'opening_time'=>'required',
                'closing_time'=>'required',
                'tax_percent'=>'required',
                'service_charge'=>'required',
                'curr_format'=>'required',
                'copyright_text'=>'required',
                'theme_color'=>'required',
            ]);
    
            if($request->input('old_logo') != ''  && !$request->logo){
                $logo = $request->input('old_logo');
            }else if($request->input('old_logo') != '' && $request->logo){
                $logo = rand().$request->logo->getClientOriginalName();
                $request->logo->move(public_path('site-images'),$logo);
                $image_path = public_path('site-images/').$request->input('old_logo');  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }else if($request->input('old_logo') == '' && $request->logo){
                $logo = rand().$request->logo->getClientOriginalName();
                $request->logo->move(public_path('site-images'),$logo);
            }else if($request->input('old_logo') == '' && !$request->logo){
               $logo = '';
            }
    
            $GeneralSetting = GeneralSetting::where(['id'=>'1'])->update([
                "app_title" => $request->input("app_title"),
                "store_name" => $request->input("store_name"),
                "address" => $request->input("address"),
                "email" => $request->input("email"),
                "phone" => $request->input("phone"),
                "logo"=>$logo,
                "opening_time" => $request->input("opening_time"),
                "closing_time" => $request->input("closing_time"),
                "service_charge" => $request->input("service_charge"),
                "tax_percent" => $request->input("tax_percent"),
                "curr_format" => $request->input("curr_format"),
                "copyright_text" => $request->input("copyright_text"),
                "theme_color" => $request->input("theme_color"),
            ]);
            return $GeneralSetting;

        }else{
            $data=  GeneralSetting::where(['id'=>'1'])->get();
            return view('admin.settings.general_settings',['data'=> $data]);
        }
    }

    public function yb_social_links(Request $request){
        if($request->input()){
            $request->validate([
                'facebook'=>'required',
                'instagram'=>'required',
                'twitter'=>'required',
                'linked_in'=>'required',
                'you_tube'=>'required',
            ]);
    
            $links = DB::table('social_links')->update([
                "facebook" => $request->input("facebook"),
                "instagram" => $request->input("instagram"),
                "twitter" => $request->input("twitter"),
                "linkedin" => $request->input("linked_in"),
                "youtube" => $request->input("you_tube"),
            ]);
            return $links;
        }else{
            $data= DB::table('social_links')->first();
            return view('admin.settings.social_links',['links'=> $data]);
        }
    }

    public function yb_kitchen_settings(Request $request){
        if($request->input()){
            $request->validate([
                'username'=>'required',
                'status'=>'required',
            ]);
            $password = $request->old_pass;
            if($request->new_pass && $request->new_pass != ''){
                $password = Hash::make($request->new_pass);
            }
    
            $links = DB::table('kitchen_setting')->update([
                "username" => $request->username,
                "password" => $password,
                "status" => $request->status,
            ]);
            return $links; 
        }else{
            $data= DB::table('kitchen_setting')->first();
            return view('admin.settings.kitchen',['kitchen'=> $data]);
        }
    }

    public function yb_contact_query(Request $request){
        if ($request->ajax()) {
            $data = ContactUsForm::latest()->get();
            return Datatables::of($data)
            ->addColumn('user',function($row){
                $user = '<h5>'.$row->name.'</h5><p>'.$row->email.'</p><p>'.$row->phone.'</p><p>'.$row->website.'</p>';
                return $user;
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
            $btn = '<button type="button" value="delete" class="btn btn-danger btn-sm delete-contact-query" data-id="'.$row->contact_id.'">Delete</button>';
                return $btn;
            })
            ->rawColumns(['user','action'])
            ->make(true);
        } 
        return view('admin.contact-query.index');
    }

    public function yb_destroy_contact_query($id)
    {
        $destroy = ContactUsForm::where('contact_id',$id)->delete();
        return  $destroy;
    }
}
