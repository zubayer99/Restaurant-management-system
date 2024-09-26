<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\ManageFood;
use App\Models\CustomerList;
use App\Models\Customer_type;
use App\Models\TableList;
use App\Models\GeneralSetting;
use App\Models\OrderMenu;
use App\Models\Waiter;
use App\Models\PaymentMethod;

use Yajra\DataTables\DataTables;

class Yb_OrderMenuController extends Controller
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
            $data = OrderMenu::select(['order_list.*','customer_list.customer_name','table_list.table_name'])
                    ->leftJoin('customer_list','order_list.customer','=','customer_list.customer_id')
                    ->leftJoin('table_list','order_list.table','=','table_list.table_id')
                    ->groupBy('order_list.id')
                    ->orderBy('order_list.id','desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function($row){
                if($row->status == '0'){
                    $food_status = '<span class="badge btn-warning">Pending</span>';
                }elseif($row->status == '1'){
                    $food_status = '<span class="badge bg-blue">On Going</span>';
                }elseif($row->status == '2'){
                    $food_status = '<span class="badge bg-blue-grey">Completed</span>';
                }else{
                    $food_status = '<span class="badge btn-danger">Cancelled</span>';
                 
                }
                return $food_status;
            })
            ->editColumn('created_at', function($row){
                return date('d M, Y',strtotime($row->created_at));
            })
            ->addColumn('action', function($row){
                $btn = '<a href="order_list/'.$row->id.'/edit" class="btn bg-cyan btn-sm waves-effect @if($order->status != "2") disabled @endif" ><i class="material-icons">edit</i></a>
                        <a href="order_list/'.$row->id.'"  class="btn btn-sm view_detail bg-green waves-effect"><i class="material-icons">visibility</i></a>
                        <button type="button" value="delete" class="btn bg-red waves-effect btn-sm delete-orderMenu @if($order->status != "2") disabled @endif" data-id="'.$row->id.'"><i class="material-icons">delete</i></button> <a href="'.url('admin/order_list/print/'.$row->id).'" class="btn btn-sm bg-blue-grey"><i class="material-icons">print</i></a>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
        } 
        return view('admin.pos_invoice.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category =  Category::select('categories.*',DB::raw("COUNT(manage_food.food_id) as food_count"))
                            ->leftJoin('manage_food','manage_food.category','=', 'categories.cat_id')
                            ->groupBy('categories.cat_id')
                            ->get();
        $manageFood = ManageFood::where('status', '=', 1)->get();
        $customerList = CustomerList::all();
        $customer_types = Customer_type::all();
        $tableList = TableList::all();
        $waiters = Waiter::all();
        return view('admin.pos_invoice.create',['category'=>$category,'managefood'=>$manageFood,'customerlist'=>$customerList,'tablelist'=>$tableList,'customer_types'=>$customer_types,'waiters'=>$waiters]);
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new OrderMenu();
        $order->customer = $request->customer_name;
        $order->customer_type = $request->customer_type;
        $order->table = $request->table;
        $order->waiter = $request->waiter;
        $order->amount = $request->total_amount;
        $order->tax_amount = $request->tax_amount;
        $order->net_amount = $request->net_amount;
        $result = $order->save();

        $items = count($request->food_id);
        for($i=0;$i<$items;$i++){
            DB::table('order_items')->insert([
                'order'=>$order->id,
                'item'=>$request->food_id[$i],
                'qty'=>$request->food_qty[$i],
                'amount'=>$request->food_qty[$i]*$request->food_price[$i],
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s')
            ]);
        }

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
        $orderMenu = OrderMenu::select(['order_list.*','customer_list.*'])
            ->join('customer_list','customer_list.customer_id','=','order_list.customer')
            ->groupBy('order_list.id')
            ->where(['order_list.id'=>$id])->first();
        $order_items = DB::table('order_items')->select(['order_items.*','manage_food.food_name'])
        ->leftJoin('manage_food','manage_food.food_id','=','order_items.item')                
        ->where('order',$orderMenu->id)->get();
        $pay_methods = PaymentMethod::where('status','1')->get();
        return view('admin.pos_invoice.show',['orderMenu'=> $orderMenu,'order_items'=>$order_items,'pay_methods'=>$pay_methods]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =  Category::select('categories.*',DB::raw("COUNT(manage_food.food_id) as food_count"))
                            ->leftJoin('manage_food','manage_food.category','=', 'categories.cat_id')
                            ->groupBy('categories.cat_id')
                            ->get();
        $manageFood = ManageFood::all()->where('status', '=', 1);
        $customerList = CustomerList::all();
        $customer_types = Customer_type::all();
        $tableList = TableList::all();
        $waiter = Waiter::all();

        $order = OrderMenu::find($id);
        $order_items = DB::table('order_items')->select(['order_items.*','manage_food.food_name'])->where('order',$id)
        ->leftJoin('manage_food','manage_food.food_id','=','order_items.item')            
        ->get();
        return view('admin.pos_invoice.edit',['order'=> $order,'category'=>$category,'managefood'=>$manageFood,'customerlist'=>$customerList,'tablelist'=>$tableList,'customer_types'=>$customer_types,'order_items'=>$order_items,'waiter'=>$waiter]);
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
        $order = OrderMenu::findOrFail($id);
        $order->customer = $request->customer_name;
        $order->customer_type = $request->customer_type;
        $order->table = $request->table;
        $order->waiter = $request->waiter;
        $order->amount = $request->total_amount;
        $order->tax_amount = $request->tax_amount;
        $order->net_amount = $request->net_amount;
        $result = $order->save();

        DB::table('order_items')->where('order',$id)->delete();

        $items = count($request->food_id);
        for($i=0;$i<$items;$i++){
            DB::table('order_items')->insert([
                'order'=>$order->id,
                'item'=>$request->food_id[$i],
                'qty'=>$request->food_qty[$i],
                'amount'=>$request->food_qty[$i]*$request->food_price[$i],
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s')
            ]);
        }

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
        $destroy = OrderMenu::where('id',$id)->delete();
        return  $destroy;
    }

    public function yb_onGoing_orders(){
        $orders= OrderMenu::whereIn('status',['0','1'])->get(); 
        
        return view('admin.pos_invoice.on-going',compact('orders'));
    }

    

    public function yb_printInvoice($id){
        $order = OrderMenu::find($id);
        $order_items = Db::table('order_items')->select(['order_items.*','manage_food.food_name'])
                        ->leftJoin('manage_food','manage_food.food_id','=','order_items.item')
                        ->where('order_items.order',$id)
                        ->get();


        return view('admin.pos_invoice.print',compact('order','order_items'));
    }




    public function yb_showCatItems(Request $request){
        $id = $request->id;
        if($id == 'all'){
            $data = ManageFood::all();
        }else{
            $data = ManageFood::where(['category'=>$id])->get();
        }
        $output = '';
        if(!empty($data)){
            foreach ($data as $value) {
                $output .=  '<div class="col-xs-6 col-md-3">
                    <a href="javascript:void(0);" class="thumbnail">';
                        if($value->image != "")
                            $output .= '<img id="image" src="'.asset('public/manage_food/'.$value->image).'" alt="" width="150px" height="150px">';
                        else
                            $output .= '<img id="image" src="'.asset('public/manage_food/default.jpg').'" alt="" width="150px" height="150px">';
                    $output .= '</a>
                        <h5 style="text-align:center; font-size:12px;">'.$value["food_name"].'</h5>
                </div>';
            }
        }
        return $output;
    }

    public function yb_searchItems(Request $request){
        $cat = $request->cat;
        $search = $request->search;
        if($cat == 'all'){
            $data = ManageFood::whereRaw('food_name LIKE "%'.$search.'%"')->get();
        }else{
            $data = ManageFood::where('category',$cat)->whereRaw('food_name LIKE "%'.$search.'%"')->get();
        }
        $output = '';
        if(!empty($data)){
            foreach ($data as $value) {
                $output .=  '<div class="col-xs-6 col-md-3">
                    <a href="javascript:void(0);" class="thumbnail">';
                        if($value->image != "")
                            $output .= '<img id="image" src="'.asset('public/manage_food/'.$value->image).'" alt="" width="150px" height="150px">';
                        else
                            $output .= '<img id="image" src="'.asset('public/manage_food/default.jpg').'" alt="" width="150px" height="150px">';
                    $output .= '</a>
                        <h5 style="text-align:center; font-size:12px;">'.$value["food_name"].'</h5>
                </div>';
            }
        }
        return $output;
    }

    public function yb_addFoodList(Request $request){
        $id = $request->input("items");
        $data = ManageFood::select(['manage_food.*'])->whereIn('food_id',$id)->get();
        $output = '';
                    foreach($data as $value){
                    $output .= '<tr>
                                    <td><input type="text" class="food_id" hidden name="food_id[]" value="'.$value["food_id"].'">'.$value["food_name"].'</td>
                                    <td class="price">'.$value["price"].'</td>
                                    <td> 
                                        <input id="item'.$value["food_id"].'" class="form-control qty_value" type="number" value="1" name="food_qty[]" style="width:60px;"/>
                                        <input type="text" hidden name="food_price[]" class="food_price" value='.$value["price"].'>
                                    </td>
                                    <td class="subtotal">'.$value["price"].'</td>
                                    <td><button type="button" value="delete" class="btn btn-danger btn-sm deleteFood" data-id="'.$value->food_id.'"><i class="fa fa-trash"></i></button></td>
                                </tr>';
                    } 
        return $output;
         
    }


    public function yb_acceptOrderByKitchen(Request $request){
        $order = OrderMenu::findOrFail($request->order);
        $order->status = '1';
        $result = $order->save();
        return $result;
    }

    public function yb_cancel_order($id){
        $order = OrderMenu::where('id',$id)->update([
            'status'=> '-1'
        ]);
        return $order;
    }


    public function yb_complete_order(Request $request){
        $method = $request->method;
        $id = $request->id;
        $order = OrderMenu::where('id',$id)->update([
            'pay_method'=> $method,
            'status'=> '2'
        ]);
        return $order;
    }

    
}
