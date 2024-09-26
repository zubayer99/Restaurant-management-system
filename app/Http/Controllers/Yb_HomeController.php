<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Category;
use App\Models\ManageFood;
use App\Models\CustomerList;
use App\Models\TableList;
use App\Models\Reservation;
use App\Models\OrderMenu;
use App\Models\GeneralSetting;
use App\Models\ContactUsForm;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;
use App\Models\MenuType;
use App\Models\Pages;
use App\Models\Banner;

use Illuminate\Http\Request;

class Yb_HomeController extends Controller
{
    public function index(){
        $data['categories'] = Category::where(['status'=>'1'])->get();
        $data['menu_list'] = MenuType::where(['status'=>'1'])->get();
        $data['banner'] = Banner::where(['status'=>'1'])->get();
		return view('public.index',$data);
    }

    public function yb_category_items($name){
        $name = str_replace('-',' ',$name);
        $cat_id = Category::where('category_name',$name)->pluck('cat_id')->first();
        $data['items_list'] = ManageFood::where(['category'=>$cat_id,'status'=>'1'])->latest()->get();
        $data['name'] = $name;
        return view('public.category',$data);
    }

    public function yb_menu_items($name){
        $name = str_replace('-',' ',$name);
        $menu_id = MenuType::where('menu_type',$name)->pluck('id')->first();
        $data['items_list'] = ManageFood::where(['menu_type'=>$menu_id,'status'=>'1'])->latest()->get();
        $data['name'] = $name;
        return view('public.category',$data);
    }

    public function yb_reservation(Request $request){
        if($request->input()){
            $date = $request->date;
            $time = $request->time;
            $person = $request->persons;
            $data['request'] = $request->all();

            $reservation = Reservation::select("table_id")
                    ->where('status', '=', 1)
                    ->where('date', '=', $date)
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>=', $time)
                    ->where('number_of_person', '=', $person)
                    ->get();
            $data['tables_list'] = TableList::select("*")
                    ->whereNotIn('table_id',$reservation)
                    ->where('capacity', '>=', $person)
                    ->get();
            // return $data;
            if($data['tables_list']){
                return view('public.partials.tables',$data);
            }else{
                return 'No Tables Available';
            }
        }
        return view('public.reservation');
    }

    public function yb_addReservation_view(){
        return view('public.confirm-reservation');
    }


    public function yb_custom_page($slug){
        $data['page'] = Pages::where('slug',$slug)->first();
        return view('public.page',$data);
    }

    public function yb_contact(){
        return view('public.contact');
    }

    public function yb_contactStore(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'message'=>'required',
        ]);

        $contactusForm = new ContactUsForm();
        $contactusForm->name = $request->name;
        $contactusForm->email = $request->email;
        $contactusForm->phone = $request->phone;
        if($request->website && $request->website != ''){
            $contactusForm->website = $request->website;
        }
        $contactusForm->message = $request->message;
        $result = $contactusForm->save();
        return $result; 
    }

    public function yb_searchItem($search){
        $items = ManageFood::where('food_name','like','%'.$search.'%')->get();
        return $items;
    }
  

}
